@extends('layouts.app')
@section('content')
<h2>Places pour le train {{ $train->design }}</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Place</th>
            <th>Occupation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($train->places as $place)
        <tr>
            <td>{{ $place->id }}</td>
            <td>
                @if($place->occupation)
                    <span class="badge bg-danger">Occupée</span>
                @else
                    <span class="badge bg-success">Libre</span>
                @endif
            </td>
            <td>
                <form action="{{ route('places.update', $place->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="occupation" value="{{ $place->occupation ? 0 : 1 }}">
                    <button type="submit" class="btn btn-sm {{ $place->occupation ? 'btn-success' : 'btn-warning' }}">
                        {{ $place->occupation ? 'Libérer' : 'Occuper' }}
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
