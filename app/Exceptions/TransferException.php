<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class TransferException extends BuildException
{
    public static function transf(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::NOT_FOUND->value,
                'message' => __('auth.' . Exceptions::NOT_FOUND->value),
                'httpCode' => Response::HTTP_UNAUTHORIZED,
            ]
        );
    }
}
