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

        Schema::create('paiment_iprs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contribuable_id')->constrained();
            $table->foreignId('employe_id')->constrained('employes');
            $table->date('date_paiement');
            $table->double('montant_employe');
            $table->double('base_imposable');
            $table->double('remuneration_brut');
            $table->double('inss');
            $table->double('mfp');
            $table->double('IPR');
            $table->double('montant_employeur');
            $table->double('total_paiement')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiment_iprs');
    }
};
