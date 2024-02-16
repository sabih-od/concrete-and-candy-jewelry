<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function getCountries()
    {
        return Country::get();
    }

    public function getCountriesById($countryId)
    {
        return Country::find($countryId);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

}
