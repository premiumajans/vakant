<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('forigners', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('phone');
            $table->text('location')->nullable();
            $table->longText('note')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('forigners');
    }
};
