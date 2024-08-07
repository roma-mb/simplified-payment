<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class TransferException extends BuildException
{
    /**
     * Has no authorize.
     *
     * @return BuildException
     */
    public static function hasNoAuthorize(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::HAS_NO_AUTHORIZE->value,
                'message' => __('exceptions.' . Exceptions::HAS_NO_AUTHORIZE->value),
                'httpCode' => Response::HTTP_FORBIDDEN,
            ]
        );
    }

    /**
     * User not found.
     *
     * @return BuildException
     */
    public static function usersNotFound(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::USERS_NOT_FOUND->value,
                'message' => __('exceptions.' . Exceptions::USERS_NOT_FOUND->value),
                'httpCode' => Response::HTTP_FOUND,
            ]
        );
    }

    /**
     * Not notified.
     *
     * @param string $data
     *
     * @return BuildException
     */
    public static function notNotified(string $data): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::NOT_NOTIFIED->value,
                'httpCode' => Response::HTTP_SERVICE_UNAVAILABLE,
                'transportedData' => $data,
            ]
        );
    }

    /**
     * Wallet not found.
     *
     * @param string $wallet
     *
     * @return BuildException
     */
    public static function walletNotFound(string $wallet): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::WALLET_NOT_FOUND->value,
                'message' => __('exceptions.' . Exceptions::WALLET_NOT_FOUND->value, ['wallet' => $wallet]),
                'httpCode' => Response::HTTP_SERVICE_UNAVAILABLE,
            ]
        );
    }
}
