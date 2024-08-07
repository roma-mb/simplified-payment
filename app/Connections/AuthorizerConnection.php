<?php

declare(strict_types=1);

namespace App\Connections;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class AuthorizerConnection
{
    /**
     * API get authorize.
     *
     * @return Response
     *
     * @throws RequestException
     */
    public static function authorize(): Response
    {
        return Http::get(Routes::authorize())->throw();
    }

    /**
     * API post notify.
     *
     * @return Response
     *
     * @throws RequestException
     */
    public static function notify(): Response
    {
        return Http::post(Routes::notify())->throw();
    }
}
