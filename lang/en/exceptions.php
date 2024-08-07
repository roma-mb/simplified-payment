<?php

declare(strict_types=1);

use App\Enumerators\Exceptions;

return [
    Exceptions::INTERNAL_ERROR->value => 'Internal error',
    Exceptions::NOT_FOUND->value => 'Not found, check data an try again.',
    Exceptions::HAS_NO_PERMISSION->value => 'Has no permission to perform :action.',
    Exceptions::HAS_NO_POLICIES->value => 'Has no policies to this action.',
    Exceptions::HAS_NO_AUTHORIZE->value => 'Has no authorize to this action.',
    Exceptions::WALLET_NOT_FOUND->value => ':wallet not found.',
    Exceptions::USERS_NOT_FOUND->value => 'Users not found.',
    Exceptions::USERS_NOT_CREATED->value => 'User not created, check data an try again.',
];
