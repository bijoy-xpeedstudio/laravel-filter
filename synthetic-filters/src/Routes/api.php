<?php
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

use Illuminate\Support\Facades\Route;
use SyntheticFilters\Controllers\FilterController;

Route::get('filter/module/{module}/{prefix}/{model}', [FilterController::class, 'searchSelect'])->name('search_select');
Route::get('filter/list/module/{module}/{prefix}/{model}', [FilterController::class, 'listWithSearch'])->name('listWithSearch');
