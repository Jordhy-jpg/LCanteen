<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::categories.index')->name('categories.index');
Route::livewire('/categories/{category}', 'pages::categories.show')->name('categories.show');
Route::livewire('/products/index', 'pages::products.index')->name('products.index');
Route::livewire('/details/{product}', 'pages::details.show')->name('details.show');
