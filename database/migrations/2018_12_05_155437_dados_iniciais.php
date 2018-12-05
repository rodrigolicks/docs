<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DadosIniciais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Insere usuário administrativo
        DB::table('users')->insert(
            array(
                'name' => 'Administrador',
                'email' => 'admin@teste.com',
                'password' => Hash::make('123456')
            )
        );        

        // Insere categoria padrão
        DB::table('categorias')->insert(
            array(
                'id' => 1,
                'nome' => 'Geral',
                'descricao' => 'Categoria padrão para documentos genéricos ou sem especificação.'
            )
        );

        // Documento exemplo
        DB::table('documentos')->insert(
            array(
                'id' => 1,
                'nome' => 'Instalação do Laravel',
                'descricao' => 'Instalação e configuração do Laravel',
                'categoria_id' => 1
            )
        );

        // Revisão de exemplo
        DB::table('revisoes')->insert(
            array(
                'id' => 1,
                'numero' => 1,                
                'nome' => 'Revisão inicial',
                'descricao' => 'Revisão inicial do documento',
                'documento_id' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
