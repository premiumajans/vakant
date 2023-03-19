<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('packages_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('package_id')->unsigned();
            $table->unsignedBiginteger('component_id')->unsigned();
            $table->foreign('package_id')->references('id')
                ->on('packages')->onDelete('cascade');
            $table->foreign('component_id')->references('id')
                ->on('components')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages_components');
    }
};
