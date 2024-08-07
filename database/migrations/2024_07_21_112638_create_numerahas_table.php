<?php

use App\Models\customers;
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
        Schema::create('numerahas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_number');
            $table->string('save_number')->default('SAVE-' . Str::uuid())->change(); // Use UUID as default
            $table->string('date');
            $table->string('numera_price');
            $table->string('sharwali_tarifa_price');
            $table->string('Customer_image')->nullable();
            $table->string('documents')->nullable();
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numerahas');
        Schema::table('numerahas', function (Blueprint $table) {
            $table->string('save_number')->nullable()->change(); // Revert if needed
        });
    }
};
