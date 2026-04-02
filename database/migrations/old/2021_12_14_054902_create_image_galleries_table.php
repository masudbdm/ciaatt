<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                  ->index()
                  ->nullable();
            $table->string('description')->nullable();
            $table->string('link_url')->nullable();
            $table->string('publish_status')->default('temp'); //temp, draft, published
            $table->bigInteger('addedby_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('editedby_id')
                  ->unsigned()
                  ->nullable();
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
        Schema::dropIfExists('image_galleries');
    }
}
