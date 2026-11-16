<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name');
        $table->string('customer_phone');
        $table->text('customer_address')->nullable();

        $table->decimal('total_price', 15, 2);
        $table->enum('payment_method', ['CASH', 'CREDIT']);

        $table->decimal('down_payment', 15, 2)->nullable();
        $table->integer('tenor_bulan')->nullable();
        $table->decimal('monthly_installment', 15, 2)->nullable(); 

        $table->timestamps();
    });

    Schema::create('order_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
        $table->foreignId('material_id')->constrained('materials');
        $table->decimal('price_at_moment', 15, 2); 
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
