<?php


use App\Http\Controllers\PosController;
use Illuminate\Auth\Events\Login;
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
Route::group(['middleware'=>"web"],function(){
    Route::get('/', [PosController::class, 'index']);
    Route::view('login','login_page');
    Route::get('/demandes', [PosController::class, 'demandesPage']);
    Route::get('/posts', [PosController::class, 'postsPage']);
    Route::get('/employes', [PosController::class, 'employesPage']);
    Route::post('login', [PosController::class, 'login'])->name('login');
    Route::post('logout', [PosController::class, 'logout'])->name('logout');
});

