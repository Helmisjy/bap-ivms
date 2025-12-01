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
        Schema::create('invoice_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_instruction_id')->constrained('invoice_instructions')->cascadeOnDelete();

            $table->string('inv_number')->nullable()->index();
            $table->text('inv_instruction')->nullable();

            $table->dateTime('inv_target')->nullable()->index();
            $table->dateTime('inv_date')->nullable();
            $table->dateTime('inv_delivery')->nullable();

            $table->dateTime('payment_due_date')->nullable()->index();
            $table->dateTime('collection_date')->nullable();
            $table->dateTime('payment_date')->nullable();

            $table->double('amount')->default(0);
            $table->integer('aging_days')->nullable()->index();
            $table->string('aging_status')->nullable(); // current, warning, overdue
            $table->string('payment_status')->default('unpaid'); // unpaid, partial, paid
            $table->string('risk_level')->nullable(); // low, medium, high
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_tracking');
    }
};
