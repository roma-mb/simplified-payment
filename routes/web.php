<?php

declare(strict_types=1);

use App\Exceptions\DomainException;
use Illuminate\Support\Facades\Route;

Route::any(
    '/{any}',
    static fn () => throw DomainException::notFound()
)->where(['any' => '.*']);
