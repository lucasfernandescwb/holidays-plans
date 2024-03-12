<?php

use App\Http\Controllers\API\Auth\UserController;
use App\Http\Controllers\API\HolidayPlan\GeneratePdfController;
use App\Http\Controllers\API\HolidayPlan\GenerateSinglePdfController;
use App\Http\Controllers\API\HolidayPlan\HolidayPlanController;
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

Route::prefix('auth')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('signup', [UserController::class, 'signup']);
});

Route::prefix('holidays-plans')->group(function () {
    Route::get('', [HolidayPlanController::class, 'index']);
    Route::get('/{holidayPlan}', [HolidayPlanController::class, 'index']);
});

Route::prefix('pdf')->group(function () {
    Route::get('holidays-plans', GeneratePdfController::class);
    Route::get('holidays-plans/{holidayPlan}', GenerateSinglePdfController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [UserController::class, 'logout']);
    Route::post('holidays-plans', [HolidayPlanController::class, 'store']);
    Route::put('holidays-plans/{holidayPlan}', [HolidayPlanController::class, 'update']);
    Route::delete('holidays-plans/{holidayPlan}', [HolidayPlanController::class, 'destroy']);
});
