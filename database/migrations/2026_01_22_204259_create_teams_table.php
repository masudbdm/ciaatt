<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto_increment primary key

            $table->string('name');
            $table->string('username')->index();
            $table->string('designation');
            $table->string('email');

            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('qualification')->nullable();
            $table->string('location')->nullable();

            $table->integer('age')->nullable();

            $table->string('gender')->default('male');

            $table->json('social_links')->nullable();

            $table->text('bio')->nullable();

            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(1); //will show in front-page
            $table->integer('drag_id')->nullable();

            $table->bigInteger('addedby_id')->unsigned()->nullable();
            $table->bigInteger('editedby_id')->unsigned()->nullable();

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
        Schema::dropIfExists('teams');
    }
}
