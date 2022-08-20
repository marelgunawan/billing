<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PoliController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'as' => 'dashboard.'
], function() {

    // Poli
    Route::group([
        'as' => 'poli.',
        'prefix' => 'poli'
    ], function() {
        
        Route::get('/', [PoliController::class, 'index'])->name('index');
        Route::get('/{poli}', [PoliController::class, 'show'])->name('view');
    
    });

    Route::get('doctor', function() {
        return view('doctor.index');
    })->name('doctor');

    Route::get('billing', function() {
        return view('billing.index');
    })->name('billing');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
