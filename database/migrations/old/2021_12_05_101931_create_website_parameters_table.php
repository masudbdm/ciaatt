<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_parameters', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable(); 
            $table->string('short_title')->nullable(); 
            $table->string('h1')->nullable();
            $table->string('slogan')->nullable();
            $table->string('logo')->nullable(); //png jpg gif
            $table->string('favicon')->nullable(); //ico
            $table->text('google_analytics_code')->nullable();
            $table->text('facebook_pixel_code')->nullable();
            $table->text('welcome_page_msg')->nullable();
            $table->text('user_page_msg')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('footer_address')->nullable();
            $table->text('footer_copyright')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('addthis_url')->nullable();
            $table->text('google_map_code')->nullable();
            $table->string('fb_page_code')->nullable();
            $table->string('fb_page_link')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('news_editions')->default('en');
            $table->integer('editedby_id')->unsigned()->nullable();
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
        Schema::dropIfExists('website_parameters');
    }
}
