<?php

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

use App\Http\Controllers\Admin\PlanoController;

Route::any('/admin/planos/search', [PlanoController::class, 'search'])->name('plans.search');
Route::get('/admin/planos', [PlanoController::class, 'index'])->name('plans.index');
Route::get('/admin/planos/create', [PlanoController::class, 'create'])->name('plans.create');
Route::post('/admin/planos', [PlanoController::class, 'store'])->name('plans.store');
Route::get('/admin/planos/{url}', [PlanoController::class, 'show'])->name('plans.show');
Route::delete('/admin/planos/{url}', [PlanoController::class, 'destroy'])->name('plans.destroy');
Route::get('/admin/plano/edit/{url}', [PlanoController::class, 'edit'])->name('plans.edit');
Route::put('/admin/plano/update/{url}', [PlanoController::class, 'update'])->name('plans.update');
Route::get('/admin', [PlanoController::class, 'index'])->name('admin.index');

Route::get('/', function () {
    return view('welcome');
});
