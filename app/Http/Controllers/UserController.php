<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(protected UserServices $userServices)
    {
    }

    /**
     * Store a user.
     *
     * @param UserFormRequest $request
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function store(UserFormRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        return response()->json(
            $this->userServices->store(attributes: $attributes),
            Response::HTTP_OK
        );
    }
}
