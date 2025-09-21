@extends('layouts.app')

@section('title', 'Liste des trains')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Liste des trains</h1>
    <a href="{{ route('trains.create') }}" class="btn btn-primary">Ajouter un train</a>
</div>

@if($trains->isEmpty())
    <div class="alert alert-info">
        Aucun train enregistré pour le moment.
    </div>
@else
{{-- Formulaire de recherche --}}
    <form action="" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text"
                   name="q"
                   class="form-control"
                   placeholder="Rechercher par design"
                   value="{{ old('q', $q ?? '') }}">
            <button class="btn btn-primary">Rechercher</button>
        </div>
    </form>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Design</th>
            <th>Nombre total de places</th>
            <th>Places disponibles</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trains as $train)
        <tr>
            <td>{{ $train->id }}</td>
            <td>{{ $train->design }}</td>
            <td>{{ $train->nbplaces }}</td>
            <td>{{ $train->places_disponibles ?? '—' }}</td>
            <td>
                <a href="{{ route('trains.edit', $train->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('trains.destroy', $train->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Confirmer la suppression de ce train ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
                <a href="{{ route('places.index', $train->id) }}" class="btn btn-sm btn-info">Voir places</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
