<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria as seguintes tabelas no banco de dados:
        * modalidades
        * processos
        * tipos_documentos
        * documentos
     */
    public function up(): void
    {
        Schema::create('modalidades', function(Blueprint $table) {
            $table->id();
            $table->string('desc');
        });

        Schema::create('processos', function(Blueprint $table) {
            $table->id();
            $table->string('objeto');
            $table->unsignedBigInteger('modalidade')->nullable();
            $table->bigInteger('numero');
            $table->year('ano');
            $table->unsignedBigInteger("requisitante")->nullable();

            //Chaves Estrangeiras
            $table->foreign('modalidade')->references('id')->on('modalidades')->onDelete('set null');
            $table->foreign('requisitante')->references('id')->on('departments')->onDelete('set null');
        });

        Schema::create('tipos_documentos', function(Blueprint $table) {
            $table->id();
            $table->string('descricao');
        });
        
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao');
            $table->unsignedBigInteger('tipo')->nullable();
            $table->unsignedBigInteger('processo')->nullable();
            $table->unsignedBigInteger('remetente')->nullable();
            $table->unsignedBigInteger('destinatario')->nullable();
            $table->boolean('precisaAssinar');
            $table->boolean('assinado');
            $table->string('arquivo');
            $table->timestamps();

            //Chaves Estrangeiras
            $table->foreign('remetente')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('destinatario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tipo')->references('id')->on('tipos_documentos')->onDelete('cascade');
            $table->foreign('processo')->references('id')->on('processos')->onDelete('set null');
        });
    }

    /**
     * Deleta as seguintes tabelas do banco de dados:
        * modalidades
        * processos
        * tipos_documentos
        * documentos
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_documentos');
        Schema::dropIfExists('processos');
        Schema::dropIfExists('documentos');
    }
};
