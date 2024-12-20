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
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name', 100);
            $table->string("bank_logo", 255)->nullable();
            $table->string('account_holder', 150);
            $table->string('account_number', 50);
            $table->enum('account_type', ['savings', 'checking']);
            $table->string('currency', 3);
            $table->string('branch_code', 50)->nullable();
            $table->string('swift_code', 20)->nullable();
            $table->string('iban', 34)->nullable();
            $table->string('reference', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_details');
    }
};