@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Modifier utilisateur</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label>Mot de passe (laisser vide pour garder le même)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_admin" class="form-check-input" id="admin" {{ $user->is_admin ? 'checked' : '' }}>
            <label class="form-check-label" for="admin">Administrateur</label>
        </div>

        <button type="submit" class="btn btn-dark">Mettre à jour</button>
    </form>
</div>
@endsection
