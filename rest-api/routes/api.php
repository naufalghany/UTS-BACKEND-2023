<?php

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

// method get
Route::get('/employee', [EmployeeController::class, "index"]);

// method post
Route::get('/employee', [EmployeeController::class, "store"]);

// method get detail resource
Route::get('/employee/{id}', [EmployeeController::class, "show"]);

// method put
Route::put('/employee/{id}', [EmployeeController::class, "update"]);

// method delete
Route::delete('/employee/{id}', [EmployeeController::class, "destroy"]);

// method search resource by name
Route::get('/employee/search/{name}', [EmployeeController::class, "search"]);

// method get active
Route::get('/employee/status/active', [EmployeeController::class, "active"]);

// method get inactive
Route::get('/employee/status/inactive', [EmployeeController::class, "inactive"]);

// method get terminated
Route::get('/employee/status/terminated', [EmployeeController::class, "terminated"]);

// middleware
Route::get('/employee', [EmployeeController::class, 'index'])->middleware('auth:sanctum');

// register akun
Route::post('/register', [AuthController::class, 'register']);

// login akun
Route::post('/login', [AuthController::class, 'login']);
