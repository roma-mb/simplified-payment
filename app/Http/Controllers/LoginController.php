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
     * @throws \Throwable
     * @throws RandomException
     */
    public function login(LoginFormRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        return response()->json([
            'token' => $this->authServices->authenticate(attributes: $attributes)
        ],
            Response::HTTP_OK
        );
    }

    public function verify(LoginFormRequest $request): JsonResponse
    {
        $userVerified = $this->authServices->verify();

        return response()->json(
            $userVerified,
            Response::HTTP_OK
        );
    }
}
