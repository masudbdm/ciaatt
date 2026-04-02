<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('file_name')
                  ->nullable();
            $table->string('file_original_name')
                  ->nullable();
            $table->string('file_mime')
                  ->nullable();
            $table->string('file_ext')
                  ->nullable();
            $table->string('file_size')
                  ->nullable();
            $table->string('file_type')
                  ->nullable(); //image, video, 
            $table->string('width')
                  ->nullable(); //for image,
            $table->string('height')
                  ->nullable(); //for image
            $table->string('file_url')
                  ->nullable();
            $table->bigInteger('addedby_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('editedby_id')
                  ->unsigned()
                  ->nullable();
            $table->string('collection_name')->nullable();
            $table->string('disk')->default('public');
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
        Schema::dropIfExists('media');
    }
}
