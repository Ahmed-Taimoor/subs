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
        Schema::create('purchase_item_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_item');
            $table->string('payment_status');
            $table->foreign('purchase_item')->references('id')->on('purchase_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_item_details');
    }
};
