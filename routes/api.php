<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryServicesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RequestBidsController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserOpinionsController;
use App\Http\Controllers\UserRequestsController;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Route::post('/sanctum/token', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [RegisterController::class, 'register'])->name('api.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('api.me');
    Orion::resource('categories', CategoriesController::class)->only(['index', 'search', 'show']);
    Orion::hasManyResource('categories', 'services', CategoryServicesController::class)->only(['index', 'search', 'show']);
    Orion::resource('services', ServicesController::class)->only(['index', 'search', 'show']);
    Orion::hasManyResource('services', 'requests', ServiceRequestController::class)->only(['index', 'search', 'show', 'store', 'update']);
    Orion::hasManyResource('users', 'requests', UserRequestsController::class)->only(['index', 'search', 'show']);
    Orion::hasManyResource('users', 'opinions', UserOpinionsController::class)->only(['index', 'search', 'show', 'store']);
    Orion::resource('requests', RequestsController::class)->only(['index', 'search', 'show', 'update']);
    Orion::hasManyResource('requests', 'bids', RequestBidsController::class)->only(['index', 'search', 'show', 'store']);
});
