<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Country;

class State extends Model {
    protected $fillable = [
        'country_id',
        'name',
        'status',
        'slug',
    ];


    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function cities() {
        return $this->hasMany(City::class);
    }
}
