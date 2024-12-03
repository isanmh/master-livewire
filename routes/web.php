<?php

use App\Http\Controllers\HomeController;
use App\Livewire\About;
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

// Route::get('/', function () {
//     return view('welcome');
// });

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

// middleware group
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', Index::class)->name('dashboard');
    Route::get('/products', ProductsList::class)->name('products');
    Route::get('/create', ProductCreate::class)->name('create');
    Route::get('/products/{id}/edit', ProductEdit::class)->name('edit');
    Route::get('/products/show/{id}', ProductShow::class)->name('show');
});
