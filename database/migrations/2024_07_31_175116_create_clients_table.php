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
        Schema::create('clients', function (Blueprint $table) {
            // Client Information
            $table->id();
            $table->string('first_name', 30);
            $table->string('last_name', 50);
            $table->string('cin', 10)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone_number', 20)->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('address', 255)->nullable();
            $table->string('email')->nullable()->unique();

            // Card Information
            $table->string('optional_name', 50)->nullable();
            $table->string('card_serial', 16)->unique();
            $table->decimal('wallet', 18, 2)->default(0.00);
            $table->date('expiry_date');
            $table->foreignId('card_id')->constrained('cards');

            // Login and Management
            $table->enum('status', ['invalid', 'active', 'pending', 'expired', 'disactivited'])->default('invalid');
            $table->string('validationKey', 6)->nullable();
            $table->enum('creator', ['admin', 'staff']);
            $table->foreignId('agency_id')->constrained('agencies');
            $table->foreignId('creator_admin_id')->nullable()->constrained('admins');
            $table->foreignId('creator_staff_id')->nullable()->constrained('staffs');
            $table->timestamps();
        });

        DB::table('clients')->insert([
            ['first_name' => 'John', 'last_name' => 'Doe', 'cin' => 'AB12345678', 'birth_date' => '1985-06-15', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'male', 'address' => '123 Elm Street, Springfield, IL, USA', 'email' => 'john.doe@example.com', 'optional_name' => 'JD', 'card_serial' => '0000123456789012', 'wallet' => 100.50, 'expiry_date' => '2025-06-15', 'card_id' => 1, 'status' => 'active', 'validationKey' => null, 'creator' => 'admin', 'agency_id' => 3, 'creator_admin_id' => 1, 'creator_staff_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Jane', 'last_name' => 'Smith', 'cin' => 'CD98765432', 'birth_date' => '1990-11-22', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'female', 'address' => '456 Oak Avenue, Metropolis, NY, USA', 'email' => 'jane.smith@example.com', 'optional_name' => 'JS', 'card_serial' => '0000234567890123', 'wallet' => 250.75, 'expiry_date' => '2025-11-22', 'card_id' => 2, 'status' => 'pending', 'validationKey' => null, 'creator' => 'staff', 'agency_id' => 4, 'creator_admin_id' => null, 'creator_staff_id' => rand(1, 15), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Michael', 'last_name' => 'Johnson', 'cin' => null, 'birth_date' => '1988-03-10', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'male', 'address' => '789 Pine Road, Gotham, NJ, USA', 'email' => 'michael.johnson@example.com', 'optional_name' => null, 'card_serial' => '0000345678901234', 'wallet' => 50.00, 'expiry_date' => '2024-03-10', 'card_id' => 3, 'status' => 'expired', 'validationKey' => null, 'creator' => 'admin', 'agency_id' => 2, 'creator_admin_id' => 1, 'creator_staff_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Emily', 'last_name' => 'Williams', 'cin' => 'EF23456789', 'birth_date' => '1995-09-30', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'female', 'address' => '101 Maple Street, Smallville, KS, USA', 'email' => 'emily.williams@example.com', 'optional_name' => 'EW', 'card_serial' => '0000456789012345', 'wallet' => 75.00, 'expiry_date' => '2024-09-30', 'card_id' => 4, 'status' => 'invalid', 'validationKey' => 'A1B2C3', 'creator' => 'staff', 'agency_id' => 5, 'creator_admin_id' => null, 'creator_staff_id' => rand(1, 15), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'William', 'last_name' => 'Brown', 'cin' => null, 'birth_date' => '1978-12-05', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'male', 'address' => '202 Birch Lane, Rivertown, CA, USA', 'email' => 'william.brown@example.com', 'optional_name' => null, 'card_serial' => '0000567890123456', 'wallet' => 300.00, 'expiry_date' => '2025-12-05', 'card_id' => 5, 'status' => 'active', 'validationKey' => null, 'creator' => 'admin', 'agency_id' => 6, 'creator_admin_id' => 1, 'creator_staff_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Ava', 'last_name' => 'Miller', 'cin' => 'GH34567890', 'birth_date' => '1983-01-12', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'female', 'address' => '303 Cherry Blossom, Centerville, TX, USA', 'email' => 'ava.miller@example.com', 'optional_name' => 'AM', 'card_serial' => '0000678901234567', 'wallet' => 120.25, 'expiry_date' => '2025-01-12', 'card_id' => 1, 'status' => 'pending', 'validationKey' => null, 'creator' => 'staff', 'agency_id' => 1, 'creator_admin_id' => null, 'creator_staff_id' => rand(1, 15), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Ethan', 'last_name' => 'Davis', 'cin' => 'IJ45678901', 'birth_date' => '1992-07-23', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'male', 'address' => '404 Cedar Drive, Kingston, OH, USA', 'email' => 'ethan.davis@example.com', 'optional_name' => 'ED', 'card_serial' => '0000789012345678', 'wallet' => 200.00, 'expiry_date' => '2025-07-23', 'card_id' => 2, 'status' => 'invalid', 'validationKey' => 'D4E5F6', 'creator' => 'staff', 'agency_id' => 3, 'creator_admin_id' => null, 'creator_staff_id' => rand(1, 15), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Sophia', 'last_name' => 'Taylor', 'cin' => 'KL56789012', 'birth_date' => '1989-08-19', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'female', 'address' => '505 Pineview Lane, Fairfield, CT, USA', 'email' => 'sophia.taylor@example.com', 'optional_name' => 'ST', 'card_serial' => '0000890123456789', 'wallet' => 75.75, 'expiry_date' => '2024-08-19', 'card_id' => 3, 'status' => 'active', 'validationKey' => null, 'creator' => 'admin', 'agency_id' => 4, 'creator_admin_id' => 1, 'creator_staff_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Liam', 'last_name' => 'Wilson', 'cin' => 'MN67890123', 'birth_date' => '1996-11-01', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'male', 'address' => '606 Oakwood Drive, Brookville, PA, USA', 'email' => 'liam.wilson@example.com', 'optional_name' => 'LW', 'card_serial' => '0000901234567890', 'wallet' => 90.00, 'expiry_date' => '2025-11-01', 'card_id' => 4, 'status' => 'pending', 'validationKey' => null, 'creator' => 'staff', 'agency_id' => 5, 'creator_admin_id' => null, 'creator_staff_id' => rand(1, 15), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Olivia', 'last_name' => 'Anderson', 'cin' => 'OP78901234', 'birth_date' => '1984-05-05', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'female', 'address' => '707 Birchwood Street, Riverton, AR, USA', 'email' => 'olivia.anderson@example.com', 'optional_name' => 'OA', 'card_serial' => '0001012345678901', 'wallet' => 150.00, 'expiry_date' => '2024-05-05', 'card_id' => 5, 'status' => 'invalid', 'validationKey' => 'F7G8H9', 'creator' => 'staff', 'agency_id' => 6, 'creator_admin_id' => null, 'creator_staff_id' => rand(1, 15), 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'James', 'last_name' => 'Moore', 'cin' => 'QR89012345', 'birth_date' => '1976-09-15', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'male', 'address' => '808 Cedar Avenue, Clearfield, FL, USA', 'email' => 'james.moore@example.com', 'optional_name' => 'JM', 'card_serial' => '0001123456789012', 'wallet' => 300.00, 'expiry_date' => '2025-09-15', 'card_id' => 1, 'status' => 'active', 'validationKey' => null, 'creator' => 'admin', 'agency_id' => 2, 'creator_admin_id' => 1, 'creator_staff_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Mia', 'last_name' => 'Martin', 'cin' => 'ST90123456', 'birth_date' => '1993-02-28', 'phone_number' => '06' . rand(10000000, 99999999), 'gender' => 'female', 'address' => '909 Maple Road, Springfield, TN, USA', 'email' => 'mia.martin@example.com', 'optional_name' => 'MM', 'card_serial' => '0001234567890123', 'wallet' => 175.00, 'expiry_date' => '2024-02-28', 'card_id' => 2, 'status' => 'pending', 'validationKey' => null, 'creator' => 'staff', 'agency_id' => 3, 'creator_admin_id' => null, 'creator_staff_id' => rand(1, 15), 'created_at' => now(), 'updated_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
