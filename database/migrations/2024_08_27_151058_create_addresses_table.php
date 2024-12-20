<?php

use App\Enums\Status;
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
            $table->id();
            $table->string("address_line_1")->nullable();
            $table->string("address_line_2")->nullable();
            $table->string("country")->nullable();
            $table->string("department")->nullable();
            $table->string("municipality")->nullable();
            $table->string("district")->nullable();
            $table->string("zip_code")->nullable();
            $table->string("type")->nullable();
            $table->string("slug")->nullable();
            $table->boolean("default")->default(true);
            $table->boolean("active")->default(true);
            $table->foreignId("customer_id")->constrained()->cascadeOnDelete();
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