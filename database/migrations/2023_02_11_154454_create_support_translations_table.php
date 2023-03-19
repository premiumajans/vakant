<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('support_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_id')->unsigned();
            $table->string('locale')->index();
            $table->string('description')->nullable();
            $table->unique(['support_id', 'locale']);
            $table->foreign('support_id')->references('id')->on('supports')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('support_translations');
    }
};
