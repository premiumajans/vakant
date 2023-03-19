<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->integer('home_views');
            $table->integer('categories_views');
            $table->integer('news_views');
            $table->integer('about_views');
            $table->integer('contact_us_views');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('views');
    }
};
