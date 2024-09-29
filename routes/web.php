<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('account', 'pages.account.dashboard')->name('account');
});