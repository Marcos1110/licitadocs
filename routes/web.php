<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnvioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SignController;
use App\Http\Middleware\AdminMiddleware;

# Rota da Home
# Route::get('/', [HomeController::class, 'index'])->name('home');

# Rotas de Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('login.destroy');
});

# Rotas com Autenticação
Route::middleware('auth')->group(function () {

    # Rota do Dashboard do Usuário
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('usuario.dashboard');

    # Rotas de Manipulação dos Documentos
    Route::controller(DocumentosController::class)->group(function () {
        Route::get('/documento/cadastrar', 'mostrarFormulario')->name('documento.form');
        Route::post('/documento/save', 'salvarDocumento')->name('documento.save');
        Route::get('/documentos-recebidos', 'documentosRecebidos')->name('documento.recebidos');
        Route::get('/documento/{id}', 'detalhesDocumento')->name('documento.visualizar');
        Route::get('/documento/{id}/arquivo', 'show')->name('documento.show');
        Route::get('/documento/{id}/download', 'download')->name('documento.download');
        Route::get('/documento/{id}/editar', 'editarDocumento')->name('documento.editar');
        Route::put('/documento/{id}/atualizar', 'atualizarDocumento')->name('documento.atualizar');
        Route::delete('/documento/{id}/excluir', 'excluirDocumento')->name('documento.excluir');
    });

    Route::controller(EnvioController::class)->group(function () {
        Route::get('/envio', 'mostrarFormulario')->name('envio.form');
        Route::post('/envio/save', 'enviarDocumento')->name('envio.save');
    });

    # Rota para assinatura de um documento
    Route::post('/documentos/{id}/assinar', [SignController::class,'assinar'])->name('documento.assinar');


    # Rota para envio de notificações
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/documento-assinado/{id}', 'msgDocumentoAssinado')->name('notificacao.assinado');
        Route::get('/documento-recebido/{id}', 'msgDocumentoRecebido')->name('notificacao.recebido');
    });
});
