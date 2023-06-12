<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->unsigned();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('company_type')->default(\App\Http\Enums\CompanyEnum::SIMPLE);
            $table->longText('voen')->nullable();
            $table->string('adress');
            $table->longText('about')->nullable();
            $table->longText('photo')->nullable();
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
