<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('session_id', 100);
            $table->integer('amount');
            $table->integer('customer_id');
            $table->integer('order_type');
            $table->integer('package_id')->nullable();
            $table->integer('order_status_id');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
