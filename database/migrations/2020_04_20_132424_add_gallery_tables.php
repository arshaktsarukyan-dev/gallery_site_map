<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGalleryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared(file_get_contents(__DIR__ . '/../sql_files/gallery_motorshow_places.sql'));
        \DB::unprepared(file_get_contents(__DIR__ . '/../sql_files/gallery_motorshow_events.sql'));
        \DB::unprepared(file_get_contents(__DIR__ . '/../sql_files/gallery_motorshow.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_motorshow');
        Schema::dropIfExists('gallery_motorshow_events');
        Schema::dropIfExists('gallery_motorshow_places');
    }
}
