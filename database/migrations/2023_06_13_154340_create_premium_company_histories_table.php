<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('premium_company_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->unsigned();
            $table->string('start_time');
            $table->string('end_time');
            $table->string('type');
            $table->integer('admin_id')->default(1);
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('premium_company_histories');
    }
};
