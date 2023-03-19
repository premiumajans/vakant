<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mode_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mode_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['mode_id', 'locale']);
            $table->foreign('mode_id')->references('id')->on('modes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mode_translations');
    }
};
