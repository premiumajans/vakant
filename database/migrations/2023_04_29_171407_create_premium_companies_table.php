<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('premium_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->unsigned();
            $table->integer('premium');
            $table->string('start_time');
            $table->string('end_time');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premium_companies');
    }
};
