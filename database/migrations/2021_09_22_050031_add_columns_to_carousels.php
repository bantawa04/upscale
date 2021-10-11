<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCarousels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('fileID')->after('thumb');
            $table->string('url')->after('fileID');
        });
        Schema::table('medias', function (Blueprint $table) {
            $table->dropColumn('path');
            $table->string('fileID')->after('thumb');
            $table->string('url')->after('fileID');
        });
        Schema::table('countries', function (Blueprint $table) {
            $table->string('fileID')->after('map');
        });     
        Schema::table('users', function (Blueprint $table) {
            $table->string('fileID')->after('avatar')->nullable();
            $table->string('type')->after('fileID');
        });   
        Schema::table('pages', function (Blueprint $table) {
            $table->integer('parentPage')->after('main')->nullable();
        });  
        Schema::table('settings', function (Blueprint $table) {
            $table->string('cover')->after('meta_description')->nullable();
            $table->integer('fileId')->after('cover')->nullable();
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn('fileID');
            $table->dropColumn('url');
        });
        Schema::table('medias', function (Blueprint $table) {
            $table->dropColumn('fileID');
            $table->dropColumn('url');
        });
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('fileID');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('fileID');
            $table->dropColumn('type');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('parentPage');
        });
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('cover');
            $table->dropColumn('fileId');
        });
    }
}
