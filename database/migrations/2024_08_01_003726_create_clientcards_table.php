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
        Schema::create('client_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_client')->constrained('clients')->onDelete('cascade');
            $table->foreignId('id_card')->constrained('cards')->onDelete('cascade');
            $table->string('card_serial');
            $table->decimal('wallet');
            $table->integer('id_creator');
            $table->enum('creator_type', ['admin', 'staff']);
            $table->json('card_style')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientcards');
    }
};
