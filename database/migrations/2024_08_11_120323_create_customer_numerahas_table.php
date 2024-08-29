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
        Schema::create('customer_numerahas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('numeraha_id')->constrained()->onDelete('cascade');
            $table->json('multipleDocs');
            $table->string('first_phase');
            $table->string('second_phase');
            $table->string('third_phase');
            $table->string('fourth_phase');
            $table->string('fifth_phase');
            $table->string('sixth_phase');
            $table->string('payed_price');
            $table->string('total_price');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_numerahas');
    }
};
