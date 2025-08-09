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
        Schema::create('accomplishment_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('accomplishment_details_id')->constrained('accomplishment_details');
            $table->string('filename');
            $table->string('filetype', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomplishment_photos');
    }
};