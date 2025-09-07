@extends('layouts.app')

@section('title', 'Modifier le train')

@section('content')
<div class="mb-3">
    <h1>Modifier le train : {{ $train->design }}</h1>
    <a href="{{ route('trains.index') }}" class="btn btn-secondary">← Retour à la liste</a>
</div>

<form action="{{ route('trains.update', $train->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="design" class="form-label">Design / Numéro du train</label>
        <input type="text" name="design" id="design"
               value="{{ old('design', $train->design) }}"
               class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="nbplaces" class="form-label">Nombre de places</label>
        <input type="number" name="nbplaces" id="nbplaces"
               value="{{ old('nbplaces', $train->nbplaces) }}"
               class="form-control" min="1" required>
        <small class="text-muted">
            Si vous réduisez le nombre de places, seules les places libres seront supprimées.
        </small>
    </div>

    <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
</form>
@endsection
