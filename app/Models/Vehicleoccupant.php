<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicleoccupant extends Model
{
    public function vehicle()
        {
            return $this->belongsTo(Vehicle::class);
        }
        
    use HasFactory;
    protected $guarded=[];
}

