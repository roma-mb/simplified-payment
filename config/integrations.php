<?php

declare(strict_types=1);

use App\Enumerators\Authorizer;
use App\Enumerators\Domain;

return [
    Authorizer::AUTHORIZER->value => [
        Domain::API->value => env('AUTHORIZER_API', ''),
    ],
];
