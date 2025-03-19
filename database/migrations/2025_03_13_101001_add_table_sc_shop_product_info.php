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
        Schema::create('sc_shop_product_info', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('sku', 50)->index();
            $table->string('upc', 20)->nullable()->comment('upc code');
            $table->string('ean', 20)->nullable()->comment('ean code');
            $table->string('jan', 20)->nullable()->comment('jan code');
            $table->string('isbn', 20)->nullable()->comment('isbn code');
            $table->string('mpn', 64)->nullable()->comment('mpn code');
            $table->string('image', 255)->nullable();
            $table->uuid('brand_id')->nullable()->default(0)->index();
            $table->uuid('supplier_id')->nullable()->default(0)->index();
            $table->decimal('price',15,2)->nullable()->default(0);
            $table->decimal('cost',15,2)->nullable()->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->integer('sold')->nullable()->default(0);
            $table->integer('minimum')->nullable()->default(0);
            $table->string('weight_class')->nullable();
            $table->decimal('weight',15,2)->nullable()->default(0);
            $table->string('length_class')->nullable();
            $table->decimal('length',15,2)->nullable()->default(0);
            $table->decimal('width',15,2)->nullable()->default(0);
            $table->decimal('height',15,2)->nullable()->default(0);
            $table->tinyInteger('kind')->nullable()->default(0)->comment('0:single, 1:bundle, 2:group')->index();
            $table->string('property', 50)->nullable()->default('physical')->index();
            $table->string('tax_id', 50)->nullable()->default(0)->comment('0:No-tax, auto: Use tax default')->index();
            $table->tinyInteger('status')->default(0)->index();
            $table->tinyInteger('approve')->default(1)->index();
            $table->integer('sort')->default(0);
            $table->integer('view')->default(0);
            $table->string('alias', 120)->index();
            $table->timestamp('date_lastview', $precision = 0)->nullable();
            $table->date('date_available')->nullable();
            $table->string('eisbn', 20)->nullable();
            $table->string('writer', 255)->nullable();
            $table->integer('page')->default(0);
            $table->string('year', 4)->default('');
            $table->string('edition', 255)->default('');
            $table->string('city', 255)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sc_shop_product_info');
    }
};
