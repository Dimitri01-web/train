@extends('layouts.app')

@section('title', 'Modifier une réservation')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier la réservation</h1>

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

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        {{-- Voyageur --}}
        <div class="mb-3">
            <label for="nomvoyageur" class="form-label">Nom du voyageur</label>
            <input type="text" name="nomvoyageur" id="nomvoyageur"
                   class="form-control"
                   value="{{ old('nomvoyageur', $reservation->nomvoyageur) }}" required>
        </div>

        {{-- Train --}}
        <div class="mb-3">
            <label for="train_id" class="form-label">Train</label>
            <select name="train_id" id="train_id" class="form-select" required>
                <option value="">-- Choisir un train --</option>
                @foreach($trains as $train)
                    <option value="{{ $train->id }}"
                        {{ old('train_id', $reservation->train_id) == $train->id ? 'selected' : '' }}>
                        {{ $train->design }} ({{ $train->nbplaces }} places)
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Itinéraire --}}
        <div class="mb-3">
            <label for="itineraire_id" class="form-label">Itinéraire</label>
            <select name="itineraire_id" id="itineraire_id" class="form-select" required>
                <option value="">-- Choisir un itinéraire --</option>
                @foreach($itineraires as $itineraire)
                    <option value="{{ $itineraire->id }}"
                        {{ old('itineraire_id', $reservation->itineraire_id) == $itineraire->id ? 'selected' : '' }}>
                        {{ $itineraire->villedepart }} → {{ $itineraire->villearrivee }} ({{ $itineraire->frais }} Ar)
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date de réservation --}}
        <div class="mb-3">
            <label for="date_reservation" class="form-label">Date de réservation</label>
            <input type="date" name="date_reservation" id="date_reservation"
                   class="form-control"
                   value="{{ old('date_reservation', \Carbon\Carbon::parse($reservation->date_reservation)->format('Y-m-d')) }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Retour</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
