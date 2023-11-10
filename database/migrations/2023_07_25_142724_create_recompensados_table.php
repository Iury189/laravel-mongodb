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
        Schema::create('recompensados', function (Blueprint $collection) {
            $collection->foreignId('recompensa_id')->constrained('recompensas');
            $collection->foreignId('hunter_id')->constrained('hunters');
            $collection->boolean('concluida')->default(false);
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
        Schema::dropIfExists('recompensados');
    }
};
