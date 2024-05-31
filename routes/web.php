<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;



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


Route::get('/tickets',[TicketController::class,'index']);
Route::get('/show/{slug}', [TicketController::class, 'show']);
Route::get('/edit/{slug}', [TicketController::class, 'edit']);
Route::post('/edit/{slug}', [TicketController::class, 'update']);
Route::delete('/delete/{slug}', [TicketController::class, 'destroy'])->name('tickets.destroy');
Route::get('/create',[TicketController::class,'create']);
Route::post('/create',[TicketController::class,'store']);


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');



/*
Route::resource('fileuploads', FileUploadController::class);
*/

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
    'comments' => CommentController::class,
    'categories' => CategoryController::class,
    'fileuploads' => FileUploadController::class,
]);



Route::get('/comments/destroy/{comment}', [CommentController::class,'destroy']);
