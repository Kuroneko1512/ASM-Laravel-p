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
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('sku')->unique()->nullable();
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->double('price');
            $table->double('sale_price')->nullable();
            $table->integer('quantity')->default(0);            
            $table->bigInteger('sold')->default(0);
            $table->boolean('has_variants')->default(false);
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();
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
