<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Train;
use App\Models\Itineraire;
use App\Models\Place;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Affiche la liste de toutes les réservations.
     */
    public function index()
    {
        $reservations = Reservation::with(['train', 'itineraire'])->get();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Affiche le formulaire pour créer une réservation.
     */
    public function create()
    {
        $trains = Train::with('places')->get();
        $itineraires = Itineraire::all();

        return view('reservations.create', compact('trains', 'itineraires'));
    }

    /**
     * Enregistre une nouvelle réservation.
     */
    public function store(Request $request)
    {
        $request->validate([
            'train_id'        => 'required|exists:trains,id',
            'itineraire_id'   => 'required|exists:itineraires,id',
            'date_reservation'=> 'required|date',
            'nomvoyageur'     => 'required|string|max:255',
        ]);

        // Cherche une place libre dans le train choisi
        $placeLibre = Place::where('train_id', $request->train_id)
                           ->where('occupation', false)
                           ->first();

        if (!$placeLibre) {
            return back()->withErrors([
                'train_id' => 'Aucune place disponible pour ce train.'
            ])->withInput();
        }

        // Réserver : on marque la place comme occupée
        $placeLibre->occupation = true;
        $placeLibre->save();

        // Création de la réservation (on peut y inclure place_id si ton modèle Reservation a la colonne)
        $reservation = Reservation::create([
            'train_id'        => $request->train_id,
            'itineraire_id'   => $request->itineraire_id,
            'date_reservation'=> $request->date_reservation,
            'nomvoyageur'     => $request->nomvoyageur,
            // 'place_id' => $placeLibre->id, // si tu veux garder la place associée
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation effectuée avec succès !');
    }

    /**
     * Annule une réservation (libère la place).
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Si tu as une relation directe place_id dans Reservation, tu peux retrouver la place exacte.
        // Ici, si non, on libère juste une place occupée au hasard dans le train (option simple) :
        $placeOccupee = Place::where('train_id', $reservation->train_id)
                              ->where('occupation', true)
                              ->first();
        if ($placeOccupee) {
            $placeOccupee->occupation = false;
            $placeOccupee->save();
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation annulée et place libérée.');
    }
}
