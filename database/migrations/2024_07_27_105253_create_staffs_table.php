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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->date('dateNaissance');
            $table->string('phoneNumber');
            $table->enum('gender', ['male', 'female']);
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('id_creator')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
