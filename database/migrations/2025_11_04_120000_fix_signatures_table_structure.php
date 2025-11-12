<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the old table if it exists
        Schema::dropIfExists('signatures');
        
        // Create the new signatures table with correct structure
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->string('signatureable_type');
            $table->unsignedBigInteger('signatureable_id');
            $table->longText('signature_data'); // Store base64 signature image
            $table->string('signer_name');
            $table->string('signer_email')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
            
            // Add index for polymorphic relationship
            $table->index(['signatureable_type', 'signatureable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signatures');
    }
};

