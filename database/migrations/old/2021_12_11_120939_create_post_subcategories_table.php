<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_subcategories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('addedby_id')->unsigned();
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
        Schema::dropIfExists('post_subcategories');
    }
}
