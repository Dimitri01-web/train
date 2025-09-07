<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    /**
     * Recettes par jour pour chaque train.
     */
    public function recettesParJour()
    {
        $resultats = Reservation::select(
                'train_id',
                DB::raw('DATE(date_reservation) as jour'),
                DB::raw('SUM(itineraires.frais) as total_recette')
            )
            ->join('itineraires', 'reservations.itineraire_id', '=', 'itineraires.id')
            ->groupBy('train_id', DB::raw('DATE(date_reservation)'))
            ->with('train') // pour récupérer le nom du train
            ->orderBy('jour', 'desc')
            ->get();

        return view('rapports.jour', compact('resultats'));
    }

    }
