<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function (): void {
    $this->comment('Let’s build the village.');
})->purpose('Display the MAA development message');
