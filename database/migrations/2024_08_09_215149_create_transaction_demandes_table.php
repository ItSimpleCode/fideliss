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
        Schema::create('transaction_demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_client_card')->nullable()->constrained('client_cards')->onDelete('set null');
            $table->integer('points');
            $table->foreignId('id_money_converter')->nullable()->constrained('staffs')->onDelete('set null');
            $table->string('description');
            $table->enum('status', ['Waiting', 'Done', 'Refused']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_demandes');
    }
};
