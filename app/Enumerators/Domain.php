<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Domain: string
{
    case API = 'api';
    case AUTHORIZE = 'authorize';
}
