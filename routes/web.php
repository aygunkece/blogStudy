<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;

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


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/makale/{article}/detay', [FrontController::class, 'articleDetail'])->name('front.article-detail');

Route::post('article/rate', [FrontController::class, 'rate'])->name("front.rate");
Route::post('article/get-rating', [FrontController::class, 'articleDetail'])->name("front.get-rating");

/*Route::get("/", function (){
    return view('front.article-detail');
});*/

Route::prefix("admin")->middleware("role:admin")->group(function (){
    Route::get("/", function (){
        return view('admin.index');
    })->name("admin.index");

    Route::get('/makale-listesi', [AdminController::class, 'index'])->name('admin.articles');
    Route::get('/makale/{article}/duzenle', [AdminController::class, 'edit'])->name('admin.article.edit');
    Route::post('/makale/{article}/duzenle', [AdminController::class, 'update']);
    Route::post('article/change-status', [AdminController::class, 'changeStatus'])->name("admin.article.changeStatus");
    Route::delete('/makale-sil', [AdminController::class, 'destroy'])->name('admin.article.destroy');

});
Route::prefix("writer")->middleware("role:writer")->group(function (){
    Route::get("/", function (){
        return view('writer.index');
    })->name("writer.index");
    Route::get('/makale-ekle', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/makale-ekle', [ArticleController::class, 'store']);
    Route::get('/makale-listesi', [ArticleController::class, 'index'])->name('articles');
    Route::get('/makale/{article}/duzenle', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('/makale/{article}/duzenle', [ArticleController::class, 'update']);
    Route::post('article/change-status', [ArticleController::class, 'changeStatus'])->name("article.changeStatus");

    Route::delete('/makale-sil', [ArticleController::class, 'destroy'])->name('article.destroy');


});
Route::prefix("moderator")->middleware("role:moderator")->group(function (){
    Route::get("/", function (){
        return view('moderator.index');
    })->name("moderator.index");
});



