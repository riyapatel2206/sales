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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->integer('sales_item_id')->nullable();
            $table->decimal('grand_total', 8, 2);
            $table->integer('cgst');
            $table->integer('sgst');
            $table->decimal('total', 8, 2);
            $table->enum('status', ['1', '2', '3','4']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
