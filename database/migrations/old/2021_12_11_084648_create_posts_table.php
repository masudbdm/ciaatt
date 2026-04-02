<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                  ->index()
                  ->nullable();
            $table->text('description')
                  ->nullable();
            $table->string('excerpt')->nullable();
            $table->string('feature_img_name')
                  ->nullable();
            $table->string('feature_img_original_name')
                  ->nullable();
            $table->string('feature_img_mime')
                  ->nullable();
            $table->string('feature_img_ext')
                  ->nullable();
            $table->string('status') //online desk, online protibedon
                  ->nullable();
            $table->text('tags')->nullable(); //for search
            $table->integer('read')->default(0);
            $table->boolean('headline')->default(0);
            $table->boolean('front_slider')->default(0);
            $table->boolean('highlight')->default(0);
            $table->string('publish_status')->default('temp'); //temp, draft, published

            $table->integer('published_year')->default(0);
            $table->integer('published_number')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->string('slug')->nullable();
            $table->integer('addedby_id')
                  ->unsigned()
                  ->nullable();

            $table->integer('writer_id')
                  ->unsigned()
                  ->nullable(); //user_id

            $table->integer('editedby_id')
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
        Schema::dropIfExists('posts');
    }
}
