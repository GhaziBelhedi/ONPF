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
        Schema::table('articles', function (Blueprint $table) {
            $table->renameColumn('quantite', 'quantite_magasin');
            $table->integer('quantite_centrale')->default(0)->after('nom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->renameColumn('quantite_magasin', 'quantite');
            $table->dropColumn('quantite_centrale');
        });
    }
};
