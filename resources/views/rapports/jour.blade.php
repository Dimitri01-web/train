@extends('layouts.app')

@section('title', 'Recettes par jour')

@section('content')
<h1>Recettes par jour et par train</h1>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Date</th>
            <th>Train</th>
            <th>Total recettes (€)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($resultats as $ligne)
        <tr>
            <td>{{ $ligne->jour }}</td>
            <td>{{ $ligne->train->design ?? 'N/A' }}</td>
            <td>{{ number_format($ligne->total_recette, 2, ',', ' ') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
