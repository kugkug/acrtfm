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
        Schema::create('accomplishment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('accomplishment_id')->constrained('accomplishments');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('accomplishment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomplishment_details');
    }
};