<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('admin_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('admin_id')->unsigned();
            $table->unsignedBiginteger('package_id')->unsigned();
            $table->integer('current_ads_count')->unsigned();
            $table->boolean('status');
            $table->foreign('admin_id')->references('id')
                ->on('admins')->onDelete('cascade');
            $table->foreign('package_id')->references('id')
                ->on('packages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_packages');
    }
};
