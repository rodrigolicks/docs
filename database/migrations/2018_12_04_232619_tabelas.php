<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tabelas extends Migration
{
    public function up()
    {
        // Usuários
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamps();
        });

        // Histórico de redefinição de senhas
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email', 100)->index();
            $table->string('token', 255);
            $table->timestamp('created_at')->nullable();
        });    
        
        // Categorias do documento
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 64);
            $table->string('descricao', 256);
            $table->timestamps();
        });       

        // Documento
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 64);
            $table->string('descricao', 256);
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->timestamps();
        });

        // Revisões do documento
        Schema::create('revisoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero')->unsigned();
            $table->string('nome', 64);
            $table->string('descricao', 256);
            $table->integer('documento_id')->unsigned();
            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->text('arquivo_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(){}
}
