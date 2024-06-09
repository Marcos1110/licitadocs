<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario');
            $table->foreign('usuario')->references('id')->on('users');
            $table->unsignedBigInteger('documento');
            $table->foreign('documento')->references('id')->on('documentos');
            $table->unsignedBigInteger('operacao');
            $table->foreign('operacao')->references('id')->on('operacoes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
