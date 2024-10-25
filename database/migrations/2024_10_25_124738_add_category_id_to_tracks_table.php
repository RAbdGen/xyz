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
        Schema::table('tracks', function (Blueprint $table) {
            // Ajoute category_id en tant que clé étrangère
            if (!Schema::hasColumn('tracks', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained('categories', 'category_id')->onDelete('cascade'); // Crée la contrainte de clé étrangère
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracks', function (Blueprint $table) {
            if (Schema::hasColumn('tracks', 'category_id')) {
                $table->dropForeign(['category_id']); // Supprime la contrainte de clé étrangère
                $table->dropColumn('category_id'); // Supprime la colonne category_id
            }
        });
    }
};
