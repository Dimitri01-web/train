<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    use HasFactory;
    protected $fillable = ['villedepart', 'villearrivee', 'frais'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
