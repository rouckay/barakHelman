<?php

use Composer\Semver\Constraint\Constraint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->integer('quantity');
            $table->integer('unit');
            $table->integer('total_price');
            $table->integer('dollor');
            $table->integer('dollor_unit');
            $table->integer('dollor_total');
            $table->integer('phone_number');
            $table->foreignId('user_id')->Constraint('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
