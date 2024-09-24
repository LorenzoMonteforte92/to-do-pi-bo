<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'phone_num',
        'latitude',
        'longitude',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function organisers() {
        return $this->belongsToMany(Organiser::class);
    }
}
