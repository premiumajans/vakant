<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('experience_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['experience_id', 'locale']);
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('experience_translations');
    }
};
