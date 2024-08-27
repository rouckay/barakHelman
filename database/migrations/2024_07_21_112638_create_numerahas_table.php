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
            $table->string('numera_id');
            $table->string('Land_Area');
            $table->string('date')->nullable();
            $table->string('sharwali_tarifa_price')->nullable();
            $table->string('documents')->nullable();
            $table->longText('description')->nullable();
            $table->string('numeraha_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numerahas');
    }
};
