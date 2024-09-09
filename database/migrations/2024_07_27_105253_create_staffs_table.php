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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('birth_date');
            $table->string('phone_number', 20)->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(1);
            $table->foreignId('creator_admin_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('agency_id')->nullable()->constrained('agencies')->onDelete('set null');
            $table->timestamps();
        });

        DB::table('staffs')->insert([
            ['first_name' => 'John', 'last_name' => 'Doe', 'birth_date' => '1985-06-15', 'phone_number' => '1234567890', 'gender' => 'male', 'image' => 'john_doe.jpg', 'email' => 'yy', 'password' => 'y', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Jane', 'last_name' => 'Smith', 'birth_date' => '1990-11-22', 'phone_number' => '1234567891', 'gender' => 'female', 'image' => 'jane_smith.jpg', 'email' => 'jane.smith@example.com', 'password' => 'password456', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Alice', 'last_name' => 'Johnson', 'birth_date' => '1978-03-05', 'phone_number' => '1234567892', 'gender' => 'female', 'image' => 'alice_johnson.jpg', 'email' => 'alice.johnson@example.com', 'password' => 'password789', 'active' => 0, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Emma', 'last_name' => 'Davis', 'birth_date' => '1987-12-30', 'phone_number' => '1234567893', 'gender' => 'female', 'image' => 'emma_davis.jpg', 'email' => 'emma.davis@example.com', 'password' => 'password345', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'James', 'last_name' => 'Taylor', 'birth_date' => '1989-09-11', 'phone_number' => '1234567894', 'gender' => 'male', 'image' => 'james_taylor.jpg', 'email' => 'james.taylor@example.com', 'password' => 'password234', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Olivia', 'last_name' => 'Jackson', 'birth_date' => '1991-02-14', 'phone_number' => '1234567895', 'gender' => 'female', 'image' => 'olivia_jackson.jpg', 'email' => 'olivia.jackson@example.com', 'password' => 'password345', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Lucas', 'last_name' => 'White', 'birth_date' => '1988-07-17', 'phone_number' => '1234567896', 'gender' => 'male', 'image' => 'lucas_white.jpg', 'email' => 'lucas.white@example.com', 'password' => 'password456', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Benjamin', 'last_name' => 'Rodriguez', 'birth_date' => '1982-04-05', 'phone_number' => '1234567897', 'gender' => 'male', 'image' => 'benjamin_rodriguez.jpg', 'email' => 'benjamin.rodriguez@example.com', 'password' => 'password890', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Amelia', 'last_name' => 'Clark', 'birth_date' => '1984-08-11', 'phone_number' => '1234567898', 'gender' => 'female', 'image' => 'amelia_clark.jpg', 'email' => 'amelia.clark@example.com', 'password' => 'password123', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Jacob', 'last_name' => 'Lee', 'birth_date' => '1989-07-19', 'phone_number' => '1234567899', 'gender' => 'male', 'image' => 'jacob_lee.jpg', 'email' => 'jacob.lee@example.com', 'password' => 'password456', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Isabella', 'last_name' => 'Walker', 'birth_date' => '1990-03-30', 'phone_number' => '1234567800', 'gender' => 'female', 'image' => 'isabella_walker.jpg', 'email' => 'isabella.walker@example.com', 'password' => 'password789', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Alexander', 'last_name' => 'Hall', 'birth_date' => '1987-10-05', 'phone_number' => '1234567801', 'gender' => 'male', 'image' => 'alexander_hall.jpg', 'email' => 'alexander.hall@example.com', 'password' => 'password012', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Henry', 'last_name' => 'King', 'birth_date' => '1994-05-17', 'phone_number' => '1234567802', 'gender' => 'male', 'image' => 'henry_king.jpg', 'email' => 'henry.king@example.com', 'password' => 'password789', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Daniel', 'last_name' => 'Baker', 'birth_date' => '1989-06-05', 'phone_number' => '1234567803', 'gender' => 'male', 'image' => 'daniel_baker.jpg', 'email' => 'daniel.baker@example.com', 'password' => 'password123', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Scarlett', 'last_name' => 'Gonzalez', 'birth_date' => '1991-04-30', 'phone_number' => '1234567804', 'gender' => 'female', 'image' => 'scarlett_gonzalez.jpg', 'email' => 'scarlett.gonzalez@example.com', 'password' => 'password456', 'active' => 1, 'creator_admin_id' => 1, 'agency_id' => rand(1, 6), 'created_at' => now(), 'updated_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
