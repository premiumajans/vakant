<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('term_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('term_id');
            $table->string('locale')->index();
            $table->longText('description');
            $table->unique(['term_id', 'locale']);
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('term_translations');
    }
};
