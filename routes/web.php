<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix("admin")->middleware("role:admin")->group(function (){
    Route::get("/", function (){
        return view('admin.article-list');
    })->name("admin.index");
});
Route::prefix("writer")->middleware("role:writer")->group(function (){
    Route::get("/", function (){
        return view('writer.index');
    })->name("writer.index");
    Route::get('/makale-ekle', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/makale-ekle', [ArticleController::class, 'store']);
    Route::get('/makale-listesi', [ArticleController::class, 'index'])->name('articles');
    Route::get('/makale/{article}/duzenle', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/makale/{article}/duzenle', [ArticleController::class, 'update']);
    Route::delete('/makale-sil', [ArticleController::class, 'destroy'])->name('article.destroy');


});
Route::prefix("moderator")->middleware("role:moderator")->group(function (){
    Route::get("/", function (){
        return view('moderator.index');
    })->name("moderator.index");
});
Route::get("/", function (){
   return view('front.index');
})->name("index");


