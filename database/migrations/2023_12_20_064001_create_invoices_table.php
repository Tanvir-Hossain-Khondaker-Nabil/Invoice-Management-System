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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('name');
            $table->string('price');
            $table->string('qty');
            $table->string('vat');
            $table->string('sub_total');
            $table->string('total');
            $table->string('month');
            $table->string('date');
            $table->string('invoice_number');
            $table->string('pdf');
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
