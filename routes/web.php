<?php
use App\Models\Paper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaperController;

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

Route::get('/paper', [PaperController::class, 'index'])->name('paper.index');

Route::get('/sort', [PaperController::class, 'sort'])->name('paper.sort');

Route::post('/store', [PaperController::class, 'store'])->name('paper.store');

Route::get('/destroy/{paper}', [PaperController::class, 'destroy'])->name('paper.destroy');

Route::get('/update/{paper}', [PaperController::class, 'update'])->name('paper.update');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
