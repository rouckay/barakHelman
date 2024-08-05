<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the column does not exist before adding it
        if (!Schema::hasColumn('numerahas', 'customer_id')) {
            Schema::table('numerahas', function (Blueprint $table) {
                $table->integer('customer_id')->unsigned()->after('id'); // Add after 'id' for better table organization
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the column only if it exists
        if (Schema::hasColumn('numerahas', 'customer_id')) {
            Schema::table('numerahas', function (Blueprint $table) {
                $table->dropColumn('customer_id');
            });
        }
    }
};
