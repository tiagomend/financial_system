<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('street_type', ['avenue', 'road'])->default('road');
            $table->string('street', 100);
            $table->string('number', 20);
            $table->string('complement', 50)->nullable();
            $table->string('neighborhood', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('postal_code', 9);
            $table->string('country', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
