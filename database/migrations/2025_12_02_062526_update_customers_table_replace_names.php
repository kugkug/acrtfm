<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add the new name column
        Schema::table('customers', function (Blueprint $table) {
            $table->string('name')->nullable()->after('customer_id');
        });

        // Migrate existing data: combine first_name and last_name into name
        DB::table('customers')->get()->each(function ($customer) {
            $name = trim(($customer->first_name ?? '') . ' ' . ($customer->last_name ?? ''));
            DB::table('customers')
                ->where('id', $customer->id)
                ->update(['name' => $name ?: null]);
        });

        // Drop the old columns
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the old columns
        Schema::table('customers', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('customer_id');
            $table->string('last_name')->nullable()->after('first_name');
        });

        // Migrate data back: split name into first_name and last_name
        DB::table('customers')->get()->each(function ($customer) {
            if ($customer->name) {
                $nameParts = explode(' ', $customer->name, 2);
                $firstName = $nameParts[0] ?? '';
                $lastName = $nameParts[1] ?? '';
                
                DB::table('customers')
                    ->where('id', $customer->id)
                    ->update([
                        'first_name' => $firstName ?: null,
                        'last_name' => $lastName ?: null,
                    ]);
            }
        });

        // Drop the name column
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};