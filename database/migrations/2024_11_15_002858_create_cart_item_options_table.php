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
        Schema::create('cart_item_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_option_value_id')->constrained()->cascadeOnDelete();
            $table->decimal("option_price", 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_options');
    }
};
