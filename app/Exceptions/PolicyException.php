<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class PolicyException extends BuildException
{
    public static function hasNoPolicies(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::HAS_NO_POLICIES->value,
                'message' => __('exceptions.' . Exceptions::HAS_NO_POLICIES->value),
                'httpCode' => Response::HTTP_UNAUTHORIZED,
            ]
        );
    }
}
