@extends('layouts.app')

@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">



        <!-- [ Cards ] start -->
        
        <!-- [ Cards ] end -->

        <!-- [ Users Table ] start -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Liste des Utilisateurs</h5>
                        <a href="{{ route('users.create') }}" class="btn btn-dark float-right">Créer un utilisateur</a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Admin</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->is_admin ? 'Oui' : 'Non' }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Users Table ] end -->

        <!-- [ Reservations Table ] start -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Liste des Réservations</h5>
                        <a href="{{ route('reservations.create') }}" class="btn btn-dark float-right">Créer une réservation</a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Téléphone</th>
                                        <th>Date</th>
                                        <th>Heure début</th>
                                        <th>Heure fin</th>
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
                                        <td>{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->heure_debut)->format('H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->heure_fin)->format('H:i') }}</td>
                                        <td>{{ $reservation->nombre_participants }}</td>
                                        <td>{{ number_format($reservation->total, 2) }} $</td>
                                        <td>
                                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Reservations Table ] end -->

    </div>
</div>

@endsection
