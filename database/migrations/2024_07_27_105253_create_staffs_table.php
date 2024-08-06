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
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('phone_number');
            $table->enum('gender', ['male', 'female']);
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(1);
            $table->foreignId('id_creator')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('id_branch')->nullable()->constrained('branchs')->onDelete('set null');
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
