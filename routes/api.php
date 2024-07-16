<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\CategoryController;

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

Route::apiResource('categories', CategoryController::class)->except('update');
Route::apiResource('skills', SkillController::class)->except('update');

Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('exams', ExamController::class)->except('update');
    Route::post('exams/start/{id}', [ExamController::class, 'start']);
    Route::post('exams/submit/{id}', [ExamController::class, 'submit']);
});