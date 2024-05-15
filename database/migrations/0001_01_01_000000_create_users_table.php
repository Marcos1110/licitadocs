<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria as seguintes tabelas no banco de dados:
        * departments [setores]
        * roles [cargos]
        * tokens [tokens de assinatura digital]
        * users [usuários]
     */
    public function up(): void
    {
        Schema::create('departments', function(Blueprint $table) {
            $table->id();
            $table->string('desc');
        });

        Schema::create('roles', function(Blueprint $table) {
            $table->id();
            $table->string('desc');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('department')->nullable();
            $table->unsignedBigInteger('role')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('cpf');
            $table->string('password');
            $table->timestamps();

            //Chaves Estrangeiras
            $table->foreign('department')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('role')->references('id')->on('roles')->onDelete('set null');
        });

        Schema::create('tokens', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario')->nullable();
            $table->string('certificado');
            $table->string('senha');

            $table->foreign('usuario')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
    * Deleta as seguintes tabelas do banco de dados:
        * departments [setores]
        * roles [cargos]
        * tokens [tokens de assinatura digital]
        * users [usuários]
    */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('tokens');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('sessions');
    }
};
