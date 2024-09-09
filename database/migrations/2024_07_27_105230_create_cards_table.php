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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('cost', 10, 2);
            $table->integer('period');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        DB::table('cards')->insert([
                [
                    'name' => 'Basic Card',
                    'cost' => 19.99,
                    'period' => 30,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Premium Card',
                    'cost' => 49.99,
                    'period' => 90,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Deluxe Card',
                    'cost' => 99.99,
                    'period' => 180,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Family Card',
                    'cost' => 79.99,
                    'period' => 365,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Student Card',
                    'cost' => 14.99,
                    'period' => 60,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Corporate Card',
                    'cost' => 199.99,
                    'period' => 365,
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
