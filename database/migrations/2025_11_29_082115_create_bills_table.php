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
        Schema::create('bills', function (Blueprint $table) {
           $table->id();
    $table->string('invoice_no')->unique();
    $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
    $table->date('date');
    $table->decimal('subtotal', 12, 2);
    $table->decimal('vat', 12, 2)->default(0);
    $table->decimal('discount', 12, 2)->default(0);
    $table->decimal('grand_total', 12, 2);
    $table->enum('payment_method', ['cash', 'bkash', 'nagad', 'bank', 'card']);
    $table->enum('status', ['paid', 'pending', 'due'])->default('pending');
    $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
