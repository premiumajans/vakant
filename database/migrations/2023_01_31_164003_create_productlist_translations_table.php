<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productlist_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productlist_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->string('content');
            $table->unique(['productlist_id', 'locale']);
            $table->foreign('productlist_id')->references('id')->on('productlists')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productlist_translations');
    }
};
