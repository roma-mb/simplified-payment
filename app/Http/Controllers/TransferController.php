<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TransferFormRequest;
use App\Services\TransferServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TransferController extends Controller
{
    public function __construct(
        protected TransferServices $transferServices
    ) {
    }

    /**
     * Make a transfer.
     *
     * @param TransferFormRequest $request
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function transfer(TransferFormRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        return response()->json(
            $this->transferServices->transfer(attributes: $attributes),
            Response::HTTP_OK
        );
    }
}
