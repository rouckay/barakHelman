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
            $table->string('job')->nullable();
            $table->foreignIdFor(Numeraha::class)->nullable();
            $table->string('Customer_image')->nullable();
            $table->string('responsable_name');
            $table->string('responsable_father_name')->nullable();
            $table->string('responsable_grand_father_name')->nullable();
            $table->string('responsable_province')->nullable();
            $table->string('responsable_village')->nullable();
            $table->string('responsable_tazkira')->nullable();
            $table->string('responsable_mobile_number')->nullable();
            $table->string('responsable_image')->nullable();
            $table->string('responsable_job')->nullable();
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
