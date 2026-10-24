<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\ProfileController;

Route::get('/', [SiteController::class, 'index']) -> name('home');
Route::post('/agendar', [SiteController::class,'store']) -> name('agendar');

Route::middleware(['auth','verified']) -> group(function (){
    Route::get('/dashboard', [AdminController::class, 'index']) -> name('dashboard');
    Route::patch('/agendamentos/{id}/status', [AdminController::class, 'atualizarStatus']) -> name('agendamentos.status');
    Route::resource('servicos', ServicoController::class)->except(['show']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/expedientes', [ServicoController::class, 'storeExpedientes'])->name('expedientes.store');
});

require __DIR__.'/auth.php';
