<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $us = Country::create(['name' => 'United States']);
        $canada = Country::create(['name' => 'Canada']);

        $usStates = [
            'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut',
            'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa',
            'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan',
            'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
            'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma',
            'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah',
            'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming', 'District of Columbia', 'American Samoa',
            'Guam', 'Northern Mariana Islands', 'Puerto Rico', 'United States Minor Outlying Islands', 'Virgin Islands, U.S'


        ];

        foreach ($usStates as $stateName) {
            State::create(['name' => $stateName, 'country_id' => $us->id]);
        }

        $canadaStates = [
            'Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'New Brunswick', 'Newfoundland and Labrador',
            'Northwest Territories', 'Nova Scotia', 'Nunavut', 'Ontario', 'Quebec', 'Saskatchewan', 'Yukon Territory'


        ];

        foreach ($canadaStates as $stateName) {
            State::create(['name' => $stateName, 'country_id' => $canada->id]);
        }

    }
}
