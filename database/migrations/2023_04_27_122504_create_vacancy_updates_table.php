<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vacancy_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->unsigned();
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
            $table->string('shared_time');
            $table->string('admin_status');
            $table->foreign('vacancy_id')
                ->references('id')
                ->on('vacancies')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancy_updates');
    }
};
