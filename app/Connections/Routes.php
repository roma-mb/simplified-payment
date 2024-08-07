<?php

declare(strict_types=1);

namespace App\Connections;

use App\Enumerators\Authorizer;

final class Routes
{
    public const AUTHORIZE = 'authorize';

    public const NOTIFY = 'notify';

    /**
     * Return authorize URI.
     *
     * @return string
     */
    public static function authorize(): string
    {
        return Authorizer::getApiURI(version: 'v2') . self::AUTHORIZE;
    }

    /**
     * Return notify URI.
     *
     * @return string
     */
    public static function notify(): string
    {
        return Authorizer::getApiURI(version: 'v1') . self::NOTIFY;
    }
}
