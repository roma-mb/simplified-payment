<?php

declare(strict_types=1);

use App\Enumerators\Exceptions;

return [
    Exceptions::NOT_FOUND->value => 'Not found, check data an try again.',
    Exceptions::HAS_NO_PERMISSION->value => 'Has no permission to perform :action action.',
    Exceptions::HAS_NO_POLICIES->value => 'Has no policies to this action.',
];
