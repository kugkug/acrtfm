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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('priority', 10)->nullable();
            $table->decimal('estimated_hours', 10, 2)->nullable();
            $table->date('schedule_date')->nullable();
            $table->time('schedule_time')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};