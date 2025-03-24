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
            if (Schema::hasColumn('sc_shop_customer_address', 'id_addr')) {
                $table->dropColumn('id_addr');
            }
        });

        Schema::table('sc_shop_customer_address', function (Blueprint $table) {
            $table->string('id_addr', 255)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sc_shop_customer_address', function (Blueprint $table) {
            $table->dropColumn('id_addr');
        });
    }
};
