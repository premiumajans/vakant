<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->integer('category_id');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('min_age');
            $table->integer('max_age');
            $table->integer('education_id');
            $table->integer('experience_id');
            $table->integer('city_id');
            $table->integer('mode_id');
            $table->integer('company_type');
            $table->string('company')->nullable();
            $table->string('relevant_people');
            $table->longText('candidate_requirement');
            $table->longText('job_description');
            $table->string('email');
            $table->string('phone');
            $table->string('admin_status');
            $table->string('tags')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
};
