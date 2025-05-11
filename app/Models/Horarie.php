<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarie extends Model
{
    use HasFactory;
    protected $guarded=[];
    // protected $fillable = ['day', 'starttime', 'lasttime', 'vehicle_id' ,'typemantenimiento_id', 'activitie_id'];

    // public function maintenance()
    // {
    //     return $this->belongsTo(Activitie::class);
    // }

    // public function vehicle()
    // {
    //     return $this->belongsTo(Vehicle::class);
    // }
}
