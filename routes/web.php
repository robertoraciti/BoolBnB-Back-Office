<?php

use App\Http\Controllers\Admin\ApartmentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Guest\PageController as GuestPageController;


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

Route::get('/', [GuestPageController::class, 'index'])->name('guest.home');


Route::middleware(['auth', 'verified'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {

    Route::get('/', [AdminPageController::class, 'index'])->name('home');
    Route::resource('apartments', ApartmentController::class);
    Route::get('/apartments/{apartment}/advertise', [ApartmentController::class, 'advertise'])->name('apartments.advertise');
    Route::get('/apartments/{apartment}/messages', [ApartmentController::class, 'messages'])->name('apartments.messages');
    Route::post('/apartments/{apartment}/advertise/checkout', [ApartmentController::class, 'advCheckout'])->name('advertisement.checkout');

  });

Route::get('/register', 'AuthController@index');


require __DIR__ . '/auth.php';