@extends('layouts.app')
@section('content')
<h2>Ajouter un train</h2>
<form action="{{ route('trains.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Design</label>
        <input type="text" name="design" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nombre de places</label>
        <input type="number" name="nbplaces" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Créer</button>
</form>
@endsection
