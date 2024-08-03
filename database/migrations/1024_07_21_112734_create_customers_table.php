<?php

use App\Models\Numeraha;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('grand_father_name')->nullable();
            $table->string('province')->nullable();
            $table->string('village')->nullable();
            $table->string('tazkira')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('parmanent_address')->nullable();
            $table->string('current_address')->nullable();
            $table->string('job')->nullable();
            $table->foreignIdFor(Numeraha::class)->nullable();
            $table->string('payed_price');
            // $table->string('due_price');
            $table->string('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
