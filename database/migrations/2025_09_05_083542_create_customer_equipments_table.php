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
        Schema::create('customer_equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('customer_location_id')->nullable()->constrained('customer_locations')->onDelete('set null');
            $table->string('equipment_name'); // e.g., "HVAC Unit #1", "Generator A", "Chiller System"
            $table->string('equipment_type'); // e.g., "HVAC", "Generator", "Chiller", "Boiler"
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('installation_date')->nullable();
            $table->date('last_service_date')->nullable();
            $table->date('next_service_date')->nullable();
            $table->string('warranty_expiry')->nullable();
            $table->text('specifications')->nullable(); // JSON or text field for equipment specs
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_equipments');
    }
};
