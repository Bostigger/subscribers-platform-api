<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Versioning your API
Route::prefix('v1')->group(function () {
    // Creating a new post
    Route::post('/websites/{website}/posts', [PostController::class, 'store'])
        ->name('posts.store'); // Naming the route for easier reference

    // Subscribing to a website
    Route::post('/websites/{website}/subscribe', [SubscriptionController::class, 'subscribe'])
        ->name('websites.subscribe'); // Naming the route for easier reference
});
