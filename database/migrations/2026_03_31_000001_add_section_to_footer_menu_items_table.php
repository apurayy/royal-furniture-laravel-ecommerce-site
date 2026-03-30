<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('footer_menu_items', function (Blueprint $table) {
            $table->string('section')->default('footer_links')->after('url');
        });

        // Backfill existing entries to footer_links
        \App\Models\FooterMenuItem::query()->update(['section' => 'footer_links']);
    }

    public function down()
    {
        Schema::table('footer_menu_items', function (Blueprint $table) {
            $table->dropColumn('section');
        });
    }
};
