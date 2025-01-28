<?php

use App\Http\Controllers\CostCenterController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::resource('suppliers', SupplierController::class);
Route::resource('costcenter', CostCenterController::class);
