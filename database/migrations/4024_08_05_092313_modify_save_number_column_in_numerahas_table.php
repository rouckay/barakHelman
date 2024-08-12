<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('numerahas', function (Blueprint $table) {
            if (!Schema::hasColumn('numerahas', 'save_number')) {
                $table->string('save_number')->default('SAVE-' . Str::uuid());
            } else {
                $table->string('save_number')->default('SAVE-' . Str::uuid())->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('numerahas', function (Blueprint $table) {
            $table->string('save_number')->nullable()->change();
        });
    }
};

