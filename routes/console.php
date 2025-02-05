<?php

declare(strict_types=1);

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote()); /* @phpstan-ignore variable.undefined */
})->purpose('Display an inspiring quote');
