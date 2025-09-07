<?php

namespace App\Http\Controllers;

use App\Models\Train;
use App\Models\Place;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    /**
     * Afficher la liste des trains.
     */
    public function index()
    {
        // On récupère tous les trains avec le nombre de places libres
        $trains = Train::withCount([
            'places as places_disponibles' => function ($query) {
                $query->where('occupation', false);
            }
        ])->get();

        return view('trains.index', compact('trains'));
    }

    /**
     * Afficher le formulaire de création d’un train.
     */
    public function create()
    {
        return view('trains.create');
    }

    /**
     * Enregistrer un nouveau train et ses places.
     */
    public function store(Request $request)
    {
        $request->validate([
            'design'   => 'required|string|max:255',
            'nbplaces' => 'required|integer|min:1',
        ]);

        $train = Train::create([
            'design'   => $request->design,
            'nbplaces' => $request->nbplaces,
        ]);

        // Génération automatique des places
        for ($i = 1; $i <= $train->nbplaces; $i++) {
            Place::create([
                'train_id'   => $train->id,
                'occupation' => false,
            ]);
        }

        return redirect()->route('trains.index')->with('success', 'Train créé avec ses places.');
    }

    /**
     * Afficher le formulaire d’édition d’un train.
     */
    public function edit($id)
    {
        $train = Train::with('places')->findOrFail($id);
        return view('trains.edit', compact('train'));
    }

    /**
     * Mettre à jour un train et ajuster ses places.
     */
    public function update(Request $request, $id)
    {
        $train = Train::findOrFail($id);

        $request->validate([
            'design'   => 'required|string|max:255',
            'nbplaces' => 'required|integer|min:1',
        ]);

        $ancienNbPlaces = $train->nbplaces;
        $nouveauNbPlaces = $request->nbplaces;

        // Mise à jour des infos du train
        $train->update([
            'design'   => $request->design,
            'nbplaces' => $nouveauNbPlaces,
        ]);

        // Si le nombre de places augmente → ajouter des places
        if ($nouveauNbPlaces > $ancienNbPlaces) {
            $placesAAjouter = $nouveauNbPlaces - $ancienNbPlaces;
            for ($i = 0; $i < $placesAAjouter; $i++) {
                Place::create([
                    'train_id'   => $train->id,
                    'occupation' => false,
                ]);
            }
        }

        // Si le nombre de places diminue → supprimer les places libres
        if ($nouveauNbPlaces < $ancienNbPlaces) {
            $placesASupprimer = $ancienNbPlaces - $nouveauNbPlaces;

            // Supprimer uniquement des places libres (jamais les occupées)
            $placesLibres = Place::where('train_id', $train->id)
                                  ->where('occupation', false)
                                  ->take($placesASupprimer)
                                  ->get();

            foreach ($placesLibres as $place) {
                $place->delete();
            }
        }

        return redirect()->route('trains.index')->with('success', 'Train mis à jour.');
    }

    /**
     * Supprimer un train et ses places.
     */
    public function destroy($id)
    {
        $train = Train::findOrFail($id);
        $train->delete();

        return redirect()->route('trains.index')->with('success', 'Train supprimé.');
    }
}
