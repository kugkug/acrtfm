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
        Schema::create('airconditioners', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->text('url');
            $table->string('brand');
            $table->index(['sku', 'brand']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airconditioners');
    }
};
