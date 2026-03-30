<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('footer_menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->boolean('opens_in_new_tab')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('footer_menu_items');
    }
};
