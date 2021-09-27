<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('days');
            $table->integer('price');
            $table->integer('max_altitude');
            $table->text('overview');
            $table->text('note')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('status')->default(0);   
            $table->boolean('promote')->default(0);            
            $table->text('title');
            $table->text('meta_title');
            $table->text('meta_description');
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
        Schema::dropIfExists('tours');
    }
}
