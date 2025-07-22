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
        Schema::create('manual_analyses', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('file_path');
            $table->text('summary');
            $table->json('keywords');
            $table->json('metadata')->nullable();
            $table->text('full_text')->nullable();
            $table->string('model_number')->nullable();
            $table->string('brand')->nullable();
            $table->string('type')->nullable(); // AC, Heat Pump, etc.
            $table->integer('file_size')->nullable();
            $table->timestamp('analyzed_at');
            $table->timestamps();
            
            $table->index(['filename']);
            $table->index(['brand', 'model_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_analyses');
    }
};