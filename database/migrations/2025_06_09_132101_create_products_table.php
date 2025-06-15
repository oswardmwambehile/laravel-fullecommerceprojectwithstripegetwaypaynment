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
            $table->string('title')->nullable();              // nullable title
            $table->text('description')->nullable();          // nullable description
            $table->string('image')->nullable();              // nullable image
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // nullable category
            $table->integer('quantity')->nullable();          // nullable quantity
            $table->decimal('price', 10, 2)->nullable();       // nullable price
            $table->decimal('discount_price', 10, 2)->nullable(); // nullable discount
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
