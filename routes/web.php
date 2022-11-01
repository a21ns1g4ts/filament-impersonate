<?php

use Illuminate\Support\Facades\Route;
use XliteDev\FilamentImpersonate\Controllers\ImpersonateController;

Route::get('filament-impersonate/leave', fn () => ImpersonateController::leave())
    ->name('filament-impersonate.leave')
    ->middleware(config('filament-impersonate.leave_middlewares'));
