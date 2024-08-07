<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $email;
 * @property int $id
 * @property Wallet $wallet
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'cpf',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Sync user role.
     *
     * @param string $slug
     *
     * @return User
     */
    public function syncRole(string $slug): User
    {
        $role = Role::where('slug', $slug)->firstOrFail();
        $role->users()->syncWithoutDetaching($this);

        return $this;
    }

    /**
     * Sync user wallet.
     *
     * @return $this
     */
    public function syncWallet(): User
    {
        Wallet::factory()->create([
            'user_id' => $this->id,
        ]);

        return $this;
    }

    /**
     * Relationship Role_User.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Relationship Permission_Role.
     *
     * @return Builder|BelongsToMany
     */
    public function permissions(): Builder|BelongsToMany
    {
        return $this->roles()->select('roles.id', 'roles.slug')->with('permissions:id,slug');
    }

    /**
     * Relationship User Has Wallet.
     *
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }
}
