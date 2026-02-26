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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->decimal('sub_total', 12, 2);
            $table->decimal('grand_total', 12, 2);
            $table->decimal('vat', 10, 2);
            $table->decimal('service_charge', 10, 2)->nullable();
            $table->string('payment_method');
            $table->string('payment_status');
            $table->date('payment_due')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
