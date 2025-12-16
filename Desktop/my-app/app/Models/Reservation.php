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
    ];

}
