<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/account/inactive', function () {
    return response('Account inactive (suspended/incomplete/unverified).', 403);
})->name('account.inactive');

Route::middleware(['check.account.status'])->group(function () {
    Route::get('/dashboard', function () {
        return response('Dashboard (active accounts only).');
    })->name('dashboard');
});
