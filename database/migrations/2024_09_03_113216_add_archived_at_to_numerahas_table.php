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
        Schema::table('numerahas', function (Blueprint $table) {
            $table->archivedAt(); // This adds the archived_at column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('numerahas', function (Blueprint $table) {
            $table->dropColumn('archived_at');
        });
    }
};
