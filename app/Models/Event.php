<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'description',
        'latitude',
        'longitude',
        'date',
        'time',
        'reservation_required',
        'cost',
        'slug'
    ];
    
    public function newProfile(){
        return $this->belongsTo(NewProfile::class);
    }
}
