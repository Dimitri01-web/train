@extends('layouts.app')
@section('content')
<h2>Ajouter un itinéraire</h2>
<form action="{{ route('itineraires.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Ville départ</label>
        <input type="text" name="villedepart" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Ville arrivée</label>
        <input type="text" name="villearrivee" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Frais (Ar)</label>
        <input type="number" name="frais" class="form-control" step="0.01" required>
    </div>
    <button type="submit" class="btn btn-success">Créer</button>
</form>
@endsection
