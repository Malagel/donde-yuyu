<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;

Route::get('/', [ProductController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/clear', [CartController::class, 'clear']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::post('/cart/checkout', [CartController::class, 'checkout']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/export/csv', [AdminController::class, 'exportCsv']);
Route::get('/admin/export/pdf', [AdminController::class, 'exportPdf']);