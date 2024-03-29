<?php

use App\Http\Controllers\ApiLikedController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MapController;
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
Route::get('/mapopt/{opt}/{gu}/{sopt}/{sshape}', [MapController::class, 'getopt']);
Route::get('/mapopt', [MapController::class, 'getpark']);

// 찜
Route::post('/liked/post/{s_no}', [ApiLikedController::class, 'store']);
Route::delete('/liked/delete/{s_no}', [ApiLikedController::class, 'destroy']);

Route::get('/admin/{pageNum}',[ManagerController::class, 'getUser']);
Route::get('/admin/{searchWorld}/{listNumber}/{pageNum}',[ManagerController::class, 'search']);
Route::delete('/admin',[ManagerController::class, 'deleteUser']);
Route::post('/admin',[ManagerController::class, 'adminLoginCheck']);
