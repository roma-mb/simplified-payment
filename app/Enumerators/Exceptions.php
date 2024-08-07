<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Exceptions: string
{
    case NOT_FOUND = 'notFound';
    case UNAUTHORIZED = 'unauthorized';
    case HAS_NO_PERMISSION = 'hasNoPermission';
    case HAS_NO_POLICIES = 'hasNoPolicies';
}
