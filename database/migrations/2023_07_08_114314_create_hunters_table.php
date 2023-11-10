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
            $collection->double('altura_hunter');
            $collection->double('peso_hunter');
            $collection->foreignId('tipo_hunter_id')->constrained('tipos_hunters');
            $collection->foreignId('tipo_nen_id')->constrained('tipos_nens');
            $collection->foreignId('tipo_sangue_id')->constrained('tipos_sanguineos');
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
