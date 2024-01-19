<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\PizzaController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('pizzas', [PizzaController::class, 'index']);
Route::post('pizzas', [PizzaController::class, 'upload']);
Route::put('pizzas/edit/{id}', [PizzaController::class, 'edit']);
Route::delete('pizzas/{id}', [PizzaController::class, 'delete']);
Route::get('students', [StudentController::class, 'index']);