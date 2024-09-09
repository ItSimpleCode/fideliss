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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 255);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        DB::table('agencies')->insert([
            [
                'name' => 'FIDELIS',
                'address' => '123 Avenue des Champs-Élysées, 75008 Paris, France',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ASSABIL',
                'address' => '456 Rue de Rivoli, 75001 Paris, France',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FIDELIS AGADIR',
                'address' => '789 Boulevard du 20 Août, Agadir 80000, Morocco',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FIDLEIS BERCHID',
                'address' => '101 Avenue de la Liberté, Berchid 20300, Morocco',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FIDELIS DAR BOUAZZA',
                'address' => '202 Rue de la Gare, Dar Bouazza 27300, Morocco',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KSASSUR',
                'address' => '303 Boulevard Mohammed V, Casablanca 20000, Morocco',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency');
    }
};
