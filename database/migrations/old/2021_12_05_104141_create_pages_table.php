<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('slug');
            $table->text('content')->nullable();
            $table->bigInteger('drag_id')->unsigned()->nullable();
            $table->boolean('title_hide')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('list_in_menu')->default(0);
            $table->bigInteger('addedby_id')
                  ->unsigned();
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
        Schema::dropIfExists('pages');
    }
}
