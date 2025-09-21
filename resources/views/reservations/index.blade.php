@extends('layouts.app')

@section('title', 'Liste des réservations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Liste des réservations</h1>
    <a href="{{ route('reservations.create') }}" class="btn btn-primary">Nouvelle réservation</a>
</div>

@if($reservations->isEmpty())
    <div class="alert alert-info">
        Aucune réservation effectuée pour le moment.
    </div>
@else
<form action="{{ route('reservations.search') }}" method="GET" class="mb-3 row g-2">
    <div class="col-md-4">
        <input type="text" name="voyageur" value="{{ $nomVoyageur ?? '' }}" class="form-control" placeholder="Nom du voyageur">
    </div>
    <div class="col-md-3">
        <select name="train" class="form-select">
            <option value="">-- Train --</option>
            @foreach($trains as $train)
                <option value="{{ $train->id }}" {{ ($trainId ?? '') == $train->id ? 'selected' : '' }}>
                    {{ $train->design }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <input type="date" name="date" value="{{ $dateReservation ?? '' }}" class="form-control">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-outline-primary w-100">Rechercher</button>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Train</th>
            <th>Itinéraire</th>
            <th>Date de réservation</th>
            <th>Voyageur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
        <tr>
            <td>{{ $reservation->id }}</td>
            <td>{{ $reservation->train->design ?? 'N/A' }}</td>
            <td>
                @if($reservation->itineraire)
                    {{ $reservation->itineraire->villedepart }} → {{ $reservation->itineraire->villearrivee }}
                @else
                    N/A
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}</td>
            <td>{{ $reservation->nomvoyageur }}</td>
            <td>
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Confirmer l\'annulation de cette réservation ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Annuler</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
