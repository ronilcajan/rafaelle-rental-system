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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('terms')->nullable();
            $table->string('least_terms')->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('penalty',10,2)->nullable();
            $table->integer('discount')->default(0);
            $table->decimal('amount',10,2)->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};