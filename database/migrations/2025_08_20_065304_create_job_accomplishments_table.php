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
        Schema::create('job_accomplishments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_area_id')->constrained('job_areas');
            $table->string('accomplishment')->nullable();
            $table->date('accomplishment_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_accomplishments');
    }
};