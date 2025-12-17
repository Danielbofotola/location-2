<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'numero_telephone',
        'date',
        'heure_debut',
        'heure_fin',
        'nombre_participants',
        'total',
    ];

    protected $casts = [
        'date' => 'date',          // transforme en Carbon
        'heure_debut' => 'datetime:H:i', // ou 'string' si tu veux rester simple
        'heure_fin' => 'datetime:H:i',
    ];
}
