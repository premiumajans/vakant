<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->integer('causer_type');
            $table->integer('causer_id')->nullable();
            $table->string('admin_status');
            $table->string('admin_id')->nullable();
            $table->string('shared_time');
            $table->string('approved_time')->nullable();
            $table->string('end_time')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
};
