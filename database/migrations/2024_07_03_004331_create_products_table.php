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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string('slug')->unique();
            $table->text("short_description");
            $table->text("long_description")->nullable();
            $table->string("main_image");
            $table->decimal("price", 10, 2);
            $table->decimal("max_price", 10, 2)->nullable();
            $table->decimal("offer_price", 10, 2)->nullable();
            $table->date("offer_start_date")->nullable();
            $table->date("offer_end_date")->nullable();
            $table->boolean("offer_active")->default(false);
            $table->boolean("is_active")->default(true);
            $table->string("status")->default("draft");
            $table->string("sku")->nullable();;
            $table->string("barcode")->nullable();
            $table->decimal("weight", 10, 2)->nullable();
            $table->integer("stock")->nullable();
            $table->integer("min_stock")->nullable();
            $table->integer("max_stock")->nullable();
            $table->boolean("is_top")->default(false);
            $table->foreignId("categorie_id")->constrained()->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
