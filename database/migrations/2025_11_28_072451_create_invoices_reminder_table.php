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
        Schema::create('invoice_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoice_trackings')->cascadeOnDelete();
            $table->string('reminder_type'); // email, whatsapp, phonecall
            $table->dateTime('reminder_date')->nullable();
            $table->string('status')->default('scheduled'); // scheduled, sent, failed
            $table->dateTime('sent_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices_reminder');
    }
};
