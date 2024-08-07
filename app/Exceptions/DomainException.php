<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class DomainException extends BuildException
{
    /**
     * Not found.
     *
     * @return BuildException
     */
    public static function notFound(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::NOT_FOUND->value,
                'message' => __('exceptions.' . Exceptions::NOT_FOUND->value),
                'httpCode' => Response::HTTP_UNAUTHORIZED,
            ]
        );
    }
}
