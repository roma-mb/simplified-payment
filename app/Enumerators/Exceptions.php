<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Exceptions: string
{
    case INTERNAL_ERROR = 'internalError';
    case NOT_FOUND = 'notFound';
    case UNAUTHORIZED = 'unauthorized';
    case HAS_NO_PERMISSION = 'hasNoPermission';
    case HAS_NO_POLICIES = 'hasNoPolicies';
    case HAS_NO_AUTHORIZE = 'hasNoAuthorize';
    case NOT_NOTIFIED = 'notNotified';
    case WALLET_NOT_FOUND = 'walletNotFound';
    case USERS_NOT_FOUND = 'usersNotFound';
    case USERS_NOT_CREATED = 'userNotCreated';
}
