<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Services\AuthServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Random\RandomException;

class LoginController extends Controller
{
    public function __construct(
        public AuthServices $authServices
    ) {
    }

    /**
     * Login user.
     *
     * @param LoginFormRequest $request
     *
     * @return JsonResponse
     *
     * @throws RandomException
     * @throws \Throwable
     */
    public function login(LoginFormRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        return response()->json(
            [
                'token' => $this->authServices->authenticate(attributes: $attributes),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Verify registered user.
     *
     * @return JsonResponse
     */
    public function verify(): JsonResponse
    {
        $userVerified = $this->authServices->verify();

        return response()->json(
            $userVerified,
            Response::HTTP_OK
        );
    }
}
