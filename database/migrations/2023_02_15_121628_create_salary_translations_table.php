<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('salary_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['salary_id', 'locale']);
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('salary_translations');
    }
};
