<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Widen first so doubled values (up to 10.00) fit before they're written.
        DB::statement('ALTER TABLE movie_ratings MODIFY rating DECIMAL(4, 2) NOT NULL');
        DB::table('movie_ratings')->update(['rating' => DB::raw('rating * 2')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('movie_ratings')->update(['rating' => DB::raw('rating / 2')]);
        DB::statement('ALTER TABLE movie_ratings MODIFY rating DECIMAL(3, 2) NOT NULL');
    }
};
