<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SignController;
use App\Http\Middleware\AdminMiddleware;

# Rota da Home
Route::get('/', [HomeController::class, 'index'])->name('home');

# Rotas de Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login'); // Página de login
    Route::post('/login', 'store')->name('login.store'); // Processamento do login
    Route::get('/logout', 'destroy')->name('login.destroy'); // Logout
});

# Rotas com Autenticação
Route::middleware('auth')->group(function () {

    # Rota do Dashboard do Usuário
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('usuario.dashboard');

    # Rotas de Manipulação dos Documentos
    Route::controller(DocumentosController::class)->group(function () {
        Route::get('/upload', 'index')->name('documentos.index');
        Route::post('/upload', 'store')->name('documento.upload');
        Route::get('/documentos/{id}', 'viewer')->name('documento.viewer');
        Route::get('/documento/{id}/arquivo', 'show')->name('documento.show');
    });

    # Rota para assinatura de um documento
    Route::post('/documentos/{id}/assinar', [SignController::class,'assinar'])->name('documento.assinar');

    # Rota para envio de notificações
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/documento-assinado/{id}', 'msgDocumentoAssinado')->name('notificacao.assinado');
        Route::get('/documento-recebido/{id}', 'msgDocumentoRecebido')->name('notificacao.recebido');
    });
});
