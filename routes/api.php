<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\PlanController;

Route::get("/users", [userController::class, "index"]);

Route::get("/users/{id}", [userController::class, "show"]);

Route::post("/users", [userController::class, "store"]);

Route::put("/delete/users/{id}", [userController::class, "delete"]);

Route::get("/plans", [PlanController::class, "index"]);

Route::post("/plans", [PlanController::class, "store"]);

Route::get("/states", [StateController::class, "index"]);

Route::get("/states/{id}", [StateController::class, "show"]);

Route::put("/delete/states", [StateController::class,"delete"]);
