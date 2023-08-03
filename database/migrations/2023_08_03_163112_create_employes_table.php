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
        Schema::disableForeignKeyConstraints();

        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('cni')->unique()->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('status_employe')->nullable();
            $table->double('salaire_base');
            $table->double('frais_deplacement');
            $table->double('indeminite_compansatoire')->nullable();
            $table->double('avantage_en_nature')->nullable();
            $table->foreignId('contribuable_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
