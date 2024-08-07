<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Authorizer: string
{
    case CONFIG_FILE = 'integrations';
    case AUTHORIZER = 'authorizer';

    /**
     * Return a base Authorizer API URL.
     *
     * @return mixed
     */
    public static function getApiBaseURL(): mixed
    {
        return config(
            self::CONFIG_FILE->value . '.' . self::AUTHORIZER->value . '.' . Domain::API->value,
            ''
        );
    }

    /**
     * Return Authorizer API URI by version.
     *
     * @param string $version
     *
     * @return string
     */
    public static function getApiURI(string $version): string
    {
        return self::getApiBaseURL() . $version . '/';
    }
}
