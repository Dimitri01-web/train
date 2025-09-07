<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Application de réservation de trains')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS depuis CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optionnel : Custom CSS --}}
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; }
        .container { margin-top: 30px; }
    </style>
</head>
<body>

{{-- Barre de navigation --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('trains.index') }}">Trains</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('itineraires.index') }}">Itinéraires</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reservations.index') }}">Réservations</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('rapports.jour') }}">Recette</a></li>

            </ul>
        </div>
    </div>
</nav>

{{-- Contenu principal --}}
<div class="container">
    {{-- Messages de succès --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Messages d’erreur --}}
    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    {{-- Erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Zone où les pages injectent leur contenu --}}
    @yield('content')
</div>

{{-- Scripts Bootstrap depuis CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
