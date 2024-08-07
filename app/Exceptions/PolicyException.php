<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class PolicyException extends BuildException
{
    /**
     * Has no permission.
     *
     * @param string $action
     *
     * @return BuildException
     */
    public static function hasNoPermission(string $action): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::HAS_NO_PERMISSION->value,
                'message' => __('exceptions.' . Exceptions::HAS_NO_PERMISSION->value, ['action' => $action]),
                'httpCode' => Response::HTTP_UNAUTHORIZED,
            ]
        );
    }
}
