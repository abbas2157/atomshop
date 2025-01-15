<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboards.admin.index');
})->name('admin');
