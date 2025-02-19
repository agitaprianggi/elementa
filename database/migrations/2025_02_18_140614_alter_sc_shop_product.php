<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sc_shop_product', function (Blueprint $table) {
            if (Schema::hasColumn('sc_shop_product', 'eisbn')) {
                $table->dropColumn('eisbn');
            }
            if (Schema::hasColumn('sc_shop_product', 'page')) {
                $table->dropColumn('page');
            }
            if (Schema::hasColumn('sc_shop_product', 'year')) {
                $table->dropColumn('year');
            }
            if (Schema::hasColumn('sc_shop_product', 'edition')) {
                $table->dropColumn('edition');
            }
            if (Schema::hasColumn('sc_shop_product', 'city')) {
                $table->dropColumn('city');
            }
        });

        Schema::table('sc_shop_product', function (Blueprint $table) {
            $table->string('eisbn', 20)->nullable();
            $table->integer('page')->default(0);
            $table->string('year', 4)->default('');
            $table->string('edition', 255)->default('');
            $table->string('city', 255)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sc_shop_product', function (Blueprint $table) {
            $table->dropColumn('eisbn');
            $table->dropColumn('page');
            $table->dropColumn('year');
            $table->dropColumn('edition');
            $table->dropColumn('city');
        });
    }
};
