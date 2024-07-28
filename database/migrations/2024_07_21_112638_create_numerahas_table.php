<?php

use App\Models\customers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('numerahas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_number');
            $table->string('save_number');
            $table->string('date');
            $table->string('tarifa_no');
            $table->string('transfered_money_to_bank');
            $table->string('Customer_image')->nullable();
            $table->string('documents')->nullable();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
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
