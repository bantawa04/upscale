<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->integer('discountPrice')->after('price')->unsigned(); //
            $table->integer('difficulty_id')->after('max_altitude')->unsigned(); //
            $table->integer('group_id')->after('difficulty_id')->unsigned(); //
            $table->integer('category_id')->unsigned()->after('group_id'); //  
            $table->integer('country_id')->unsigned()->after('category_id'); //            
            $table->integer('region_id')->after('country_id')->unsigned()->nullable(); //
            $table->integer('accomodation_id')->after('region_id')->unsigned(); //
            $table->integer('meal_id')->after('accomodation_id')->unsigned(); //
            $table->integer('rating_count')->after('meal_id')->nullable(); //
            $table->float('rating_cache')->after('rating_count')->nullable(); //
            $table->integer('start')->after('rating_count')->unsigned(); //
            $table->integer('end')->after('start')->unsigned(); //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('discountPrice')->nullable();
            $table->dropColumn('difficulty_id');
            $table->dropColumn('group_id');
            $table->dropColumn('category_id');
            $table->dropColumn('region_id');
            $table->dropColumn('country_id');
            $table->dropColumn('accomodation_id');
            $table->dropColumn('meal_id');
            $table->dropColumn('rating_count');
            $table->dropColumn('rating_cache');
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}
