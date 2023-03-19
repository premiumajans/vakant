<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('component_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->unique(['component_id', 'locale']);
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('component_translations');
    }
};
