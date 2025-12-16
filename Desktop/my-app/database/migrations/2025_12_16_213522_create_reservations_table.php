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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');                   // Nom
            $table->string('prenom');                // Prénom
            $table->string('numero_telephone');      // Numéro de téléphone
            $table->date('date');                     // Date jj/mm/aaaa
            $table->time('heure_debut');             // Heure de début
            $table->time('heure_fin');               // Heure de fin
            $table->integer('nombre_participants');  // Nombre de participants
            $table->timestamps();                     // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
