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
        Schema::create('selected_items', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('item');
            $table->integer('qty');
            $table->decimal('price', 8, 2); 
            $table->decimal('subtotal', 8, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selected_items');
    }
};
