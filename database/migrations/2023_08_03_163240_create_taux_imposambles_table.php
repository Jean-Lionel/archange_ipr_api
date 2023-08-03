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
        Schema::create('taux_imposambles', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->double('min_montant');
            $table->double('max_montant');
            $table->double('taux_imposamble');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taux_imposambles');
    }
};
