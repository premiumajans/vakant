<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vacancy_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->string('experience');
            $table->string('education');
            $table->unique(['vacancy_id', 'locale']);
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vacancy_translations');
    }
};
