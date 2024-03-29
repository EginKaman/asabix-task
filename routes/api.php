<?php

declare(strict_types=1);

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['as' => 'api.'], static function (): void {
    Route::middleware('localization')->apiResource('posts', PostController::class)->whereUuid(['post']);
    Route::apiResource('tags', TagController::class)->whereUuid(['tag']);
});
