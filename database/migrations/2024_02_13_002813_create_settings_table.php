<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('header_logo')->nullable();
            $table->text('footer_logo')->nullable();
            $table->text('fav_image')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('social_link_1')->nullable();
            $table->string('social_link_2')->nullable();
            $table->string('social_link_3')->nullable();
            $table->string('social_link_4')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
