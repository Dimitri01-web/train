@extends('layouts.app')
@section('content')
<h2>Nouvelle réservation</h2>
<form action="{{ route('reservations.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Train</label>
        <select name="train_id" class="form-control" required>
            @foreach($trains as $train)
            <option value="{{ $train->id }}">{{ $train->design }} ({{ $train->places->where('occupation', false)->count() }} places disponibles)</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Itinéraire</label>
        <select name="itineraire_id" class="form-control" required>
            @foreach($itineraires as $itineraire)
            <option value="{{ $itineraire->id }}">{{ $itineraire->villedepart }} → {{ $itineraire->villearrivee }} ({{ $itineraire->frais }} €)</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Nom voyageur</label>
        <input type="text" name="nomvoyageur" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Date réservation</label>
        <input type="date" name="date_reservation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Réserver</button>
</form>
@endsection
