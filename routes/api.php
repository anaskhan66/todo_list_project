<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/saveTask', function (Request $request) {
//     return $request->input;
// });

Route::post('/saveTask', [HomeController::class, 'saveTask']);
Route::get('/getTask', [HomeController::class, 'getTask']);
Route::get('/deleteTask', [HomeController::class, 'deleteTask']);
Route::get('/markAsCompleted', [HomeController::class, 'markAsCompleted']);
