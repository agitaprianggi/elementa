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
        Schema::table('sc_shop_customer_address', function (Blueprint $table) {
            if (Schema::hasColumn('sc_shop_customer_address', 'province')) {
                $table->dropColumn('province');
            }
            if (Schema::hasColumn('sc_shop_customer_address', 'regency')) {
                $table->dropColumn('regency');
            }
            if (Schema::hasColumn('sc_shop_customer_address', 'district')) {
                $table->dropColumn('district');
            }
            if (Schema::hasColumn('sc_shop_customer_address', 'subdistrict')) {
                $table->dropColumn('subdistrict');
            }
        });

        Schema::table('sc_shop_customer_address', function (Blueprint $table) {
            $table->string('province', 255)->default('');
            $table->string('regency', 255)->default('');
            $table->string('district', 255)->default('');
            $table->string('subdistrict', 255)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sc_shop_customer_address', function (Blueprint $table) {
            $table->dropColumn('province');
            $table->dropColumn('regency');
            $table->dropColumn('district');
            $table->dropColumn('subdistrict');
        });
    }
};
