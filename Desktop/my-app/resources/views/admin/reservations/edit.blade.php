@extends('layouts.admin') {{-- Ou ton layout principal --}}

@section('content')
<div class="container">
    <h1>Modifier la réservation</h1>

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" value="{{ $reservation->nom }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" value="{{ $reservation->prenom }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="numero_telephone" class="form-label">Téléphone</label>
            <input type="text" name="numero_telephone" value="{{ $reservation->numero_telephone }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" value="{{ \Carbon\Carbon::parse($reservation->date)->format('Y-m-d') }}" class="form-control" required>

        </div>

        <div class="mb-3">
            <label for="heure_debut" class="form-label">Heure début</label>
            <input type="time" name="heure_debut" value="{{ $reservation->heure_debut }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="heure_fin" class="form-label">Heure fin</label>
            <input type="time" name="heure_fin" value="{{ $reservation->heure_fin }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nombre_participants" class="form-label">Nombre de participants</label>
            <input type="number" name="nombre_participants" value="{{ $reservation->nombre_participants }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" value="{{ $reservation->total }}" class="form-control" step="0.01">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection

