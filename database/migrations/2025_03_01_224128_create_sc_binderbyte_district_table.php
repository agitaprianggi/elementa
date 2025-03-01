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
        Schema::create('sc_binderbyte_district', function (Blueprint $table) {
            $table->string('id', 50);
            $table->string('id_regency', 50);
            $table->string('name', 255);
            $table->dateTime('created_date')->useCurrent();
            $table->primary(['id', 'id_regency'], 'PK_sc_binderbyte_district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sc_binderbyte_district');
    }
};
