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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('cin');
            $table->date('birth_date');
            $table->string('phone_number');
            $table->enum('gender', ['male', 'female']);
            $table->string('image')->nullable();
            $table->string('address');
            $table->string('email')->unique();
            $table->integer('id_creator');
            $table->enum('creator_type', ['admin', 'staff']);
            $table->boolean('active')->default(1);
            $table->foreignId('id_branch')->nullable()->constrained('branchs')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
