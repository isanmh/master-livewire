<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductContoller;
use App\Livewire\About;
use App\Livewire\Crud\CardDetail;
use App\Livewire\Crud\FormCreate;
use App\Livewire\Crud\FormEdit;
use App\Livewire\Crud\TableList;
use App\Livewire\Dashboard\Index;
use App\Livewire\Dashboard\ProductCreate;
use App\Livewire\Dashboard\ProductEdit;
use App\Livewire\Dashboard\ProductShow;
use App\Livewire\Dashboard\ProductsList;
use App\Livewire\LandingPage;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Test;
use Illuminate\Support\Facades\Auth;
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

Route::get('/dashboard', function () {
    return view('pages.index');
})->name('dashboard');

// categories routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// products resource routes
Route::resource('products', ProductContoller::class);



Route::get('/crud', TableList::class);
Route::get('/crud/create', FormCreate::class);
Route::get('/crud/{id}/edit', FormEdit::class);
Route::get('/crud/show/{id}', CardDetail::class);

// live wire
Route::get('/', LandingPage::class);
Route::get('/about', About::class);
Route::get('/about/{name}', About::class);
Route::get('/test', Test::class);

Auth::routes(['register' => false, 'login' => false, 'logout' => true]);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
// Route::post('/logout', [Login::class, 'logout'])->name('logout');

// middleware group livewire
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::get('/dashboard', Index::class)->name('dashboard');
    // Route::get('/products', ProductsList::class)->name('products');
    // Route::get('/create', ProductCreate::class)->name('create');
    // Route::get('/products/{id}/edit', ProductEdit::class)->name('edit');
    // Route::get('/products/show/{id}', ProductShow::class)->name('show');
});
