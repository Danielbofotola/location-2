<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // ---------------- ADMIN ----------------

    // Liste toutes les réservations (admin)
    public function index()
    {
        $reservations = Reservation::orderBy('id', 'desc')->paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    // Formulaire création (admin)
    public function create()
    {
        return view('admin.reservations.create');
    }

    // Sauvegarde une nouvelle réservation (admin)
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numero_telephone' => 'required|string|max:20',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'nombre_participants' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès !');
    }

    // Formulaire édition (admin)
    public function edit(Reservation $reservation)
    {
        return view('admin.reservations.edit', compact('reservation'));
    }

    // Mise à jour (admin)
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numero_telephone' => 'required|string|max:20',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'nombre_participants' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès !');
    }

    // Supprimer (admin)
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès !');
    }

    // ---------------- PUBLIC ----------------

    // Formulaire réservation public
    public function createPublic()
    {
        return view('public.reservation.create'); // ton formulaire Blade public
    }

    // Sauvegarde réservation public
    public function storePublic(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numero_telephone' => 'required|string|max:20',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'nombre_participants' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        Reservation::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'numero_telephone' => $request->numero_telephone,
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'nombre_participants' => $request->nombre_participants,
            'total' => $request->total,
        ]);

        return redirect()->route('reservation.create')->with('success', 'Réservation effectuée avec succès !');
    }
}
