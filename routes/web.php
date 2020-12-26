<?php

// use App\Models\Order;
// use App\Models\Paper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\InfoController;

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
})->name('welcome');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix'=>'paper'],function(){

        Route::get('/', [PaperController::class, 'index'])->name('paper.index');

        Route::post('/sort', [PaperController::class, 'sort'])->name('paper.sort');

        Route::post('/store', [PaperController::class, 'store'])->name('paper.store');

        Route::get('/destroy/{paper}', [PaperController::class, 'destroy'])->name('paper.destroy');

        Route::get('/update/{paper}', [PaperController::class, 'update'])->name('paper.update');

        Route::get('/info/{paper}', [InfoController::class, 'index'])->name('paper.info');

    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix'=>'order'],function(){

        Route::get('/', [OrderController::class, 'index'])->name('order.index');

        //Route::post('/sort', [OrderController::class, 'sort'])->name('order.sort');

        Route::post('/store', [OrderController::class, 'store'])->name('order.store');

        Route::get('/destroy/{order}', [OrderController::class, 'destroy'])->name('order.destroy');

        Route::get('/update/{order}', [OrderController::class, 'update'])->name('order.update');

        //Route::get('/info/{order}', [InfoController::class, 'index'])->name('order.info');

    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

