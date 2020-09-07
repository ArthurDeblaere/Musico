<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('year');
            $table->string('genre');
            //nullable entries due to modifactions in code
            $table->string('cover')->nullable();
            //$table->multiLineString('description');
            $table->unsignedBigInteger('band_id')->nullable();
            //foreignkey error
            //$table->foreign('band_id')->references('id')->on('bands');

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
        Schema::dropIfExists('albums');
    }
}
