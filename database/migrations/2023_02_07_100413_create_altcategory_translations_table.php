<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('altcategory_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alt_category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['alt_category_id', 'locale']);
            $table->foreign('alt_category_id')
                ->references('id')
                ->on('alt_categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('altcategory_translations');
    }
};
