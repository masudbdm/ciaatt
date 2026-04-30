<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_parameters', function (Blueprint $table) {
            $table->string('home_services_front_title', 255)->nullable();
            $table->text('home_services_front_text')->nullable();

            $table->string('home_services_back_title', 255)->nullable();
            $table->text('home_services_back_text')->nullable();
            $table->string('home_services_back_button_text', 120)->nullable();
            $table->string('home_services_back_button_link', 500)->nullable();

            $table->string('home_services_right_1_title', 255)->nullable();
            $table->text('home_services_right_1_text')->nullable();
            $table->string('home_services_right_1_link_text', 120)->nullable();
            $table->string('home_services_right_1_link', 500)->nullable();

            $table->string('home_services_right_2_title', 255)->nullable();
            $table->text('home_services_right_2_text')->nullable();
            $table->string('home_services_right_2_link_text', 120)->nullable();
            $table->string('home_services_right_2_link', 500)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('website_parameters', function (Blueprint $table) {
            $table->dropColumn([
                'home_services_front_title',
                'home_services_front_text',
                'home_services_back_title',
                'home_services_back_text',
                'home_services_back_button_text',
                'home_services_back_button_link',
                'home_services_right_1_title',
                'home_services_right_1_text',
                'home_services_right_1_link_text',
                'home_services_right_1_link',
                'home_services_right_2_title',
                'home_services_right_2_text',
                'home_services_right_2_link_text',
                'home_services_right_2_link',
            ]);
        });
    }
};

