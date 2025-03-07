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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('transaction_type', ['payable', 'receivable']);
            $table->string('description');
            $table->dateTimeTz('due_date');
            $table->decimal('amount');
            $table->uuid('recipient_id');
            $table->uuid('expense_category_id');
            $table->enum('recipient_type', ['supplier', 'employee']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
