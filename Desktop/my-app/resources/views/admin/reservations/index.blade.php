@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Réservations</h1>

    <a href="{{ route('reservations.create') }}" class="btn btn-dark mb-3">Créer une réservation</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Date</th>
                <th>Heure Début</th>
                <th>Heure Fin</th>
                <th>Participants</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->nom }}</td>
                <td>{{ $reservation->prenom }}</td>
                <td>{{ $reservation->numero_telephone }}</td>
                <td>{{ $reservation->date }}</td>
                <td>{{ $reservation->heure_debut }}</td>
                <td>{{ $reservation->heure_fin }}</td>
                <td>{{ $reservation->nombre_participants }}</td>
                <td>{{ $reservation->total }}</td>
                <td>
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reservations->links() }}
</div>
@endsection
