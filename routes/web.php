<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

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

// Route::get('/', function () {return view('welcome');});

Route::get('/',[TicketController::class,'index']);

Route::get('/show/{slug}', [TicketController::class, 'show']);

Route::get('/edit/{slug}', [TicketController::class, 'edit']);
Route::post('/edit/{slug}', [TicketController::class, 'update']);

Route::delete('/delete/{slug}', [TicketController::class, 'destroy'])->name('tickets.destroy');

Route::get('/create',[TicketController::class,'create']);
Route::post('/create',[TicketController::class,'store']);
