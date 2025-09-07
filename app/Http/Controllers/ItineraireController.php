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
}
