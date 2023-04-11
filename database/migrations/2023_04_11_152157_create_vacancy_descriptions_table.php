<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vacancy_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('vacancy_id')->unsigned();
            $table->string('position');
            $table->integer('category_id');
            $table->integer('min_salary');
            $table->integer('max_salary')->nullable();
            $table->integer('min_age');
            $table->integer('max_age')->nullable();
            $table->integer('education_id');
            $table->integer('experience_id');
            $table->integer('city_id');
            $table->integer('mode_id');
            $table->string('company')->nullable();
            $table->string('relevant_people');
            $table->longText('candidate_requirement');
            $table->longText('job_description');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('tags')->nullable();
            $table->foreign('vacancy_id')->references('id')
                ->on('vacancies')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('vacancy_descriptions');
    }
};
