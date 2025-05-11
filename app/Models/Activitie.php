<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    use HasFactory;
    protected $guarded=[];

    // protected $fillable = ['name', 'startdate', 'lastdate'];
    
    // public function horaries()
    // {
    //     return $this->hasMany(Horarie::class);
    // }

    // public function activities()
    // {
    //     return $this->hasMany(MaintenanceActivity::class);
    // }
}
