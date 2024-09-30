<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

require __DIR__ . '/auth.php';

Volt::route('/', 'pages.home')->name('home');
Volt::route('competitions', 'pages.competitions')->name('competitions');
Volt::route('past-competitions', 'pages.past-competitions')->name('past-competitions');
Volt::route('about', 'pages.about')->name('about');
Volt::route('faqs', 'pages.faqs')->name('faqs');
Volt::route('terms-conditions', 'pages.terms')->name('terms');
Volt::route('privacy-policy', 'pages.privacy')->name('privacy');
Volt::route('cookie-policy', 'pages.cookies')->name('cookies');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('account', 'pages.account.dashboard')->name('account');
});