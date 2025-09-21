<?php

namespace App\Http\Controllers;

use App\Models\Itineraire;
use Illuminate\Http\Request;

class ItineraireController extends Controller
{
    /**
     * Affiche la liste des itinéraires.
     */
    public function index()
    {
        $itineraires = Itineraire::all();
        return view('itineraires.index', compact('itineraires'));
    }

    /**
     * Affiche le formulaire pour créer un nouvel itinéraire.
     */
    public function create()
    {
        return view('itineraires.create');
    }

    /**
     * Enregistre un nouvel itinéraire.
     */
    public function store(Request $request)
    {
        $request->validate([
            'villedepart' => 'required|string|max:255',
            'villearrivee' => 'required|string|max:255',
            'frais'       => 'required|numeric|min:0',
        ]);

        Itineraire::create($request->only(['villedepart', 'villearrivee', 'frais']));

        return redirect()->route('itineraires.index')->with('success', 'Itinéraire ajouté avec succès.');
    }

    /**
     * Affiche le formulaire d’édition d’un itinéraire.
     */
    public function edit($id)
    {
        $itineraire = Itineraire::findOrFail($id);
        return view('itineraires.edit', compact('itineraire'));
    }

    /**
     * Met à jour un itinéraire existant.
     */
    public function update(Request $request, $id)
    {
        $itineraire = Itineraire::findOrFail($id);

        $request->validate([
            'villedepart' => 'required|string|max:255',
            'villearrivee' => 'required|string|max:255',
            'frais'       => 'required|numeric|min:0',
        ]);

        $itineraire->update($request->only(['villedepart', 'villearrivee', 'frais']));

        return redirect()->route('itineraires.index')->with('success', 'Itinéraire mis à jour avec succès.');
    }

    /**
     * Supprime un itinéraire.
     */
    public function destroy($id)
    {
        $itineraire = Itineraire::findOrFail($id);
        $itineraire->delete();

        return redirect()->route('itineraires.index')->with('success', 'Itinéraire supprimé avec succès.');
    }

    public function search(Request $request)
{
    $villeDepart = $request->input('villedepart');
    $villeArrivee = $request->input('villearrivee');
    $fraisMin = $request->input('frais_min');
    $fraisMax = $request->input('frais_max');

    $itineraires = \App\Models\Itineraire::query()
        ->when($villeDepart, function($q) use ($villeDepart) {
            $q->where('villedepart', 'LIKE', "%{$villeDepart}%");
        })
        ->when($villeArrivee, function($q) use ($villeArrivee) {
            $q->where('villearrivee', 'LIKE', "%{$villeArrivee}%");
        })
        ->when($fraisMin, function($q) use ($fraisMin) {
            $q->where('frais', '>=', $fraisMin);
        })
        ->when($fraisMax, function($q) use ($fraisMax) {
            $q->where('frais', '<=', $fraisMax);
        })
        ->get();

    return view('itineraires.index', compact('itineraires', 'villeDepart', 'villeArrivee', 'fraisMin', 'fraisMax'));
}

}
