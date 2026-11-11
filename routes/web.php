<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::livewire('/categories/index', 'pages::categories.index')->name('categories.index');
Route::livewire('/products/index', 'pages::products.index')->name('products.index');
