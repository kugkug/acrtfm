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
        Schema::create('job_area_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_area_id')->constrained('job_areas')->onDelete('cascade');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('type')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_area_files');
    }
};