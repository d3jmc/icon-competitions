<?php

use App\Actions\Auth\Logout;
use App\Events\UserVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('register',  'pages.auth.register')->name('register');

    Volt::route('login', 'pages.auth.login')->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('email/verify', 'pages.auth.verify-email')->name('verification.notice');

    Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended(route('account'));
    })->name('verification.verify');

    Route::get('logout', function () {
        (new Logout)->handle();

        return redirect()->intended(route('login'));
    })->name('logout');
});