<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Train;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Lister les places d’un train.
     */
    public function index($train_id)
    {
        $train = Train::with('places')->findOrFail($train_id);
        return view('places.index', compact('train'));
    }


    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);

        $request->validate([
            'occupation' => 'required|boolean',
        ]);

        $place->occupation = $request->occupation;
        $place->save();

        return back()->with('success', 'Statut de la place mis à jour.');
    }
}
