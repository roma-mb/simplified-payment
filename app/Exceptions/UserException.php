<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class UserException extends BuildException
{
    /**
     * Has no authorize.
     *
     * @return BuildException
     */
    public static function userNotCreated(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::USERS_NOT_CREATED->value,
                'message' => __('exceptions.' . Exceptions::USERS_NOT_CREATED->value),
                'httpCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ]
        );
    }
}
