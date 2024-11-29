<?php

use App\Http\Controllers\Api\PlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\userController;

Route::get("/users", [userController::class, "index"]);

Route::get("/users/{id}", [userController::class, "show"]);

Route::post("/users", [userController::class, "store"]);

Route::put("/delete/{id}", [userController::class, "delete"]);

Route::get("/plans", [PlanController::class, "index"]);

Route::post("/plans", [PlanController::class, "store"]);
