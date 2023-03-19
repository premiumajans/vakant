<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('education_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['education_id', 'locale']);
            $table->foreign('education_id')->references('id')->on('education')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('education_translations');
    }
};
