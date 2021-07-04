<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmpresaParceira extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_parceira', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social');
            $table->foreignId('id_user')->constantained('users')->cascadeOnDelete();
            $table->double('cnpj', 14)->unique();
            $table->string('telefone');
            $table->string('token');
            $table->integer('num_conta');
            $table->decimal('saldo', $precision = 15, $scale = 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_parceira');
        $table->dropForeign(['id_user']);
        $table->dropColumn('id_user');
    }
}
