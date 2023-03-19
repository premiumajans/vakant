<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_v_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('father_name');
            $table->string('birth_date');
            $table->string('location');
            $table->string('phone');
            $table->string('email');
            $table->string('cv');
            $table->string('vacancy_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('c_v_s');
    }
};
