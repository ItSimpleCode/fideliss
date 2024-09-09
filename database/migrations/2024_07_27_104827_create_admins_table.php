<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30);
            $table->string('last_name', 50);
            $table->string('phone_number', 20)->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
        DB::table('admins')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => '1234567890',
            'gender' => 'male',
            'email' => 'y',
            'password' => 'y', // Ensure to hash the password
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
