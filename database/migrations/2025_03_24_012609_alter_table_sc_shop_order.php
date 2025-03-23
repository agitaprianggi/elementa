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
        Schema::table('sc_shop_order', function (Blueprint $table) {
            $table->string('shipping_name', 255)->default('');
            $table->string('shipping_code', 255)->default('');
            $table->string('virtual_account', 255)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sc_shop_customer', function (Blueprint $table) {
            $table->dropColumn(['shipping_name', 'shipping_code', 'virtual_account']);
        });
    }
};
