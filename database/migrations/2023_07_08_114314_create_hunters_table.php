<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunters', function (Blueprint $collection) {
            $collection->string('nome_hunter');
            $collection->integer('idade_hunter');
            $collection->float('altura_hunter');
            $collection->float('peso_hunter');
            $collection->foreignId('tipo_hunter_id');
            $collection->foreignId('tipo_nen_id');
            $collection->foreignId('tipo_sangue_id');
            $collection->date('inicio');
            $collection->date('termino');
            $collection->timestamps();
            $collection->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hunters');
    }
};
