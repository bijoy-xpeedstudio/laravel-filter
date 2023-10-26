<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test', [FilterController::class, 'testPurityFilter']);
Route::get('/feed-data', [FilterController::class, 'feedData']);
Route::get('/posts', [FilterController::class, 'getPostData']);
Route::get('/posts/structure', [FilterController::class, 'getModelFilterStructure']);
