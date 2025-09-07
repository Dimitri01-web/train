<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['train_id', 'itineraire_id', 'date_reservation', 'nomvoyageur'];

    public function train()
    {
        return $this->belongsTo(Train::class);
    }

    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class);
    }
}
