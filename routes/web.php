<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

Route::get("/", [FeedController::class, "show"])->name("home");
Route::post("/", [FeedController::class, "store"])->middleware("auth")->name("home");

Route::post("/category", [CategoryController::class, "store"])->middleware("auth");

Route::get("/digest", function () {
    return "Digest";
})->middleware("auth")->name("digest");
Route::get("/discover", function () {
    return "Dscover";
})->middleware("auth")->name("discover");



Route::post("/sign-out", [AuthController::class, "signOut"])->middleware("auth");

Route::middleware("guest")->group(function () {
    Route::get("/sign-in", [AuthController::class, "signIn"])->name("login");
    Route::get("/sign-up", [AuthController::class, "signUp"]);
    Route::post("/sign-in", [AuthController::class, "logIn"]);
    Route::post("/sign-up", [AuthController::class, "register"]);
});
