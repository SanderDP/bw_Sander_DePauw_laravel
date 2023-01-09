<?php

use App\Http\Controllers\ContactFormsController;
use App\Http\Controllers\FAQCategoriesController;
use App\Http\Controllers\FAQuestionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Models\FAQCategories;
use App\Models\FAQuestions;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\NewsController::class, 'index'])->name('index');

Route::get('/about', function(){
    return view('about');
});

Route::resource('users', UserController::class);
Route::get('users/{user}/promote', [UserController::class, 'promote'])->name('users.promote');
Route::get('users/{user}/demote', [UserController::class, 'demote'])->name('users.demote');

Route::resource('news', NewsController::class);

Route::resource('FAQCategories', FAQCategoriesController::class);
Route::get('FAQ/create/{FAQ}', [FAQuestionsController::class, 'create'])->name('FAQ.createWithID');
Route::resource('FAQ', FAQuestionsController::class);

Route::resource('contact', ContactFormsController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');