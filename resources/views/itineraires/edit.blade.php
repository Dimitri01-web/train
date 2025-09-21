@extends('layouts.app')

@section('title', 'Modifier un itinéraire')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier l’itinéraire</h1>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('itineraires.update', $itineraire->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="villedepart" class="form-label">Ville de départ</label>
            <input type="text" name="villedepart" id="villedepart"
                   class="form-control" value="{{ old('villedepart', $itineraire->villedepart) }}" required>
        </div>

        <div class="mb-3">
            <label for="villearrivee" class="form-label">Ville d’arrivée</label>
            <input type="text" name="villearrivee" id="villearrivee"
                   class="form-control" value="{{ old('villearrivee', $itineraire->villearrivee) }}" required>
        </div>

        <div class="mb-3">
            <label for="frais" class="form-label">Frais (Ar)</label>
            <input type="number" step="0.01" name="frais" id="frais"
                   class="form-control" value="{{ old('frais', $itineraire->frais) }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('itineraires.index') }}" class="btn btn-secondary">Retour</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
