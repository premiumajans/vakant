<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('premium_vacancy_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->unsigned();
            $table->string('start_time');
            $table->string('end_time');
            $table->string('type');
            $table->integer('admin_id')->default(1);
            $table->foreign('vacancy_id')
                ->references('id')
                ->on('vacancies')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premium_vacancy_histories');
    }
};
