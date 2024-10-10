<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

require __DIR__ . '/auth.php';

Route::get('/test', function () {
    $user = Auth::user();

    dd($user->instantWins()->get());
});

Volt::route('/', 'pages.home')->name('home');
Volt::route('competition/{competition:slug}', 'pages.competition.show')->name('competition.show');
Volt::route('terms-conditions', 'pages.terms')->name('terms');
Volt::route('privacy-policy', 'pages.privacy')->name('privacy');
Volt::route('cookie-policy', 'pages.cookies')->name('cookies');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('account', 'pages.account.dashboard')->name('account');
    Volt::route('account/profile', 'pages.account.profile')->name('account.profile');
    Volt::route('account/tickets', 'pages.account.tickets')->name('account.tickets');
    Volt::route('account/transactions', 'pages.account.transactions')->name('account.transactions');
    Volt::route('account/security', 'pages.account.security')->name('account.security');
});