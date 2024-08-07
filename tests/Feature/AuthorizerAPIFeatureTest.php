<?php

declare(strict_types=1);

namespace Tests\Feature;

use AllowDynamicProperties;
use App\Connections\AuthorizerConnection;
use App\Connections\Routes;
use App\Enumerators\Exceptions;
use App\Enumerators\Permissions;
use App\Enumerators\Roles;
use App\Facades\Authenticator;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use App\Repository\TransferRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @property $userToken
 * @property Collection|Model $payer
 * @property Collection|Model $payee
 */
#[AllowDynamicProperties] class AuthorizerAPIFeatureTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->databaseSeeder();

        Http::fake([
            Routes::authorize() => Http::response(self::authorizerAPIMock('authorize'), Response::HTTP_OK),
            Routes::notify() => Http::response(self::authorizerAPIMock('notify'), Response::HTTP_NO_CONTENT),
        ]);
    }

    public function test_should_throw_exception_when_user_has_no_authorize_api(): void
    {
        $token = $this->authUser($this->payer);

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/transfer', [
            'value' => 100.0,
            'payer' => $this->payer->id,
            'payee' => $this->payee->id,
        ])->assertJson(['message' => __('exceptions.' . Exceptions::HAS_NO_AUTHORIZE->value)])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_should_throw_exception_authorize_api_notify(): void
    {
        $token = $this->authUser($this->payer);

        $this->mock(
            TransferRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('transfer')->andReturn(collect([
                    'payer' => $this->payer->wallet,
                    'payee' => $this->payee->wallet,
                ]));

                $mock->shouldReceive('notify')->andReturn(AuthorizerConnection::notify());
            }
        );

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/transfer', [
            'value' => 100.0,
            'payer' => $this->payer->id,
            'payee' => $this->payee->id,
        ])->assertJson(['message' => __('exceptions.internalError')])
            ->assertStatus(Response::HTTP_SERVICE_UNAVAILABLE);
    }

    private static function authorizerAPIMock(string $uri): array
    {
        return[
            'authorize' =>  [
                'status' => 'fail',
                'data' => [
                    'authorization' => false,
                ],
            ],
            'notify' =>  [
                'status' => 'error',
                'message' => 'The service is not available, try again later',
            ],
        ][$uri] ?? [];
    }

    private function databaseSeeder(): void
    {
        $this->payer = User::factory()->create();

        $payerRole = Role::factory()->create([
            'name' => Str::headline(Roles::CUSTOMER->value),
            'slug' => Roles::CUSTOMER->value,
        ]);

        $this->payer->roles()->sync($payerRole);

        $payerPermission = Permission::factory()->create([
            'slug' => Permissions::PAYER->value,
            'name' => Str::headline(Permissions::PAYER->value),
        ]);

        $receiverPermission = Permission::factory()->create([
            'slug' => Permissions::RECEIVER->value,
            'name' => Str::headline(Permissions::RECEIVER->value),
        ]);

        $payerPermission->roles()->syncWithoutDetaching($payerRole);
        $receiverPermission->roles()->syncWithoutDetaching($payerRole);

        Wallet::factory()->create(['user_id' => $this->payer->id, ]);

        $this->payee = User::factory()->create();

        $payeeRole = Role::factory()->create([
            'name' => Str::headline(Roles::SHOP_OWNER->value),
            'slug' => Roles::SHOP_OWNER->value,
        ]);

        $receiverPermission->roles()->syncWithoutDetaching($payeeRole);
        $this->payee->roles()->sync($payeeRole);

        Wallet::factory()->create(['user_id' => $this->payee->id, ]);
    }

    private function authUser(User $user): string
    {
        $token = Authenticator::generateToken($user);
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer ' . $token;

        return $token;
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($_SERVER['HTTP_AUTHORIZATION']);
    }
}
