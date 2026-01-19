<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;

Route::get("/products", [ProductController::class, 'index']);
Route::post("/products", [ProductController::class, 'store']);
Route::get("/products/{id}", [ProductController::class, 'show']);
Route::put("/products/{id}", [ProductController::class, "update"]);
Route::delete("/products/{id}", [ProductController::class, "destroy"]);

Route::get("/orders", [OrderController::class, 'index']);
Route::post("/orders", [OrderController::class, 'store']);
Route::get("/orders/{id}", [OrderController::class, 'show']);
Route::put("/orders/{id}", [OrderController::class, "update"]);
Route::delete("/orders/{id}", [OrderController::class, "destroy"]);