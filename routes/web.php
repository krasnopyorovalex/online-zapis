<?php

declare(strict_types=1);

use App\Http\Middleware\Owner;

Route::middleware([Owner::class])->group(function () {
    Route::livewire('companies', 'pages::company.index')->name('companies.index');
    Route::livewire('companies/create', 'pages::company.create')->name('companies.create');
});
