<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ArticleController;


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

Route::post('login', [LoginController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post("/delete-old-token", [LoginController::class, "deleteToken"]);

    Route::middleware("role:admin|writer")->group(function (){
        Route::get("/articles", [ArticleController::class, "index"]);
        Route::post("/article/create", [ArticleController::class, "store"]);
        Route::put("/article/update", [ArticleController::class, "update"]);
        Route::get("/article/show", [ArticleController::class, "show"]);
        Route::patch("/article/status-change", [ArticleController::class, "status"]);
        Route::delete("/article/delete", [ArticleController::class, "delete"]);

    });
});

