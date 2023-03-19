<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('success_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('success_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->string('description')->nullable();
            $table->unique(['success_id', 'locale']);
            $table->foreign('success_id')->references('id')->on('successes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('success_translations');
    }
};
