<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [LoginController::class, 'login']);
Route::get('/unauthenticated', function () {
    return response()->json(['message' => 'Unauthenticated User'], 401);
})->name('login');

Route::middleware('auth:api')->group(function () {

});
