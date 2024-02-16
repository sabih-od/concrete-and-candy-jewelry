<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name'];

    public function getStates()
    {
        return State::all();
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function getStatesByCountry($countryId)
    {
        return State::where('country_id', $countryId)->get();
    }
}
