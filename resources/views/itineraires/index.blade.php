@extends('layouts.app')

@section('title', 'Liste des itinéraires')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Liste des itinéraires</h1>
    <a href="{{ route('itineraires.create') }}" class="btn btn-primary">Ajouter un itinéraire</a>
</div>

@if($itineraires->isEmpty())
    <div class="alert alert-info">
        Aucun itinéraire enregistré pour le moment.
    </div>
@else
<form action="{{ route('itineraires.search') }}" method="GET" class="mb-3 row g-2">
    <div class="col-md-3">
        <input type="text" name="villedepart" value="{{ $villeDepart ?? '' }}" class="form-control" placeholder="Ville de départ">
    </div>
    <div class="col-md-3">
        <input type="text" name="villearrivee" value="{{ $villeArrivee ?? '' }}" class="form-control" placeholder="Ville d'arrivée">
    </div>
    <div class="col-md-2">
        <input type="number" name="frais_min" value="{{ $fraisMin ?? '' }}" class="form-control" placeholder="Frais min">
    </div>
    <div class="col-md-2">
        <input type="number" name="frais_max" value="{{ $fraisMax ?? '' }}" class="form-control" placeholder="Frais max">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-outline-primary w-100">Rechercher</button>
    </div>
</form>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Ville de départ</th>
            <th>Ville d’arrivée</th>
            <th>Frais</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itineraires as $itineraire)
        <tr>
            <td>{{ $itineraire->id }}</td>
            <td>{{ $itineraire->villedepart }}</td>
            <td>{{ $itineraire->villearrivee }}</td>
            <td>{{ number_format($itineraire->frais, 2, ',', ' ') }} Ar</td>
            <td>
                <a href="{{ route('itineraires.edit', $itineraire->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('itineraires.destroy', $itineraire->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Confirmer la suppression de cet itinéraire ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
