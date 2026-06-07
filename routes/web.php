<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware("auth");

Route::post("/sign-out", [AuthController::class, "signOut"])->middleware("auth");


Route::middleware("guest")->group(function () {
    Route::get("/sign-in", [AuthController::class, "signIn"])->name("login");
    Route::get("/sign-up", [AuthController::class, "signUp"]);
    Route::post("/sign-in", [AuthController::class, "logIn"]);
    Route::post("/sign-up", [AuthController::class, "register"]);
});
