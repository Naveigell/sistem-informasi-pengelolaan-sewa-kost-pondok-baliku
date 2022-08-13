<?php

namespace App\Database\Seeds;

use App\Models\RoomFacility;
use CodeIgniter\Database\Seeder;

class RoomFacilitySeeder extends Seeder
{
    public function run()
    {
        $facility = new RoomFacility();
        $types    = ['Dapur & Kamar Mandi Dalam', 'Water Heater', 'Lemari', 'Kasur', 'TV', 'AC'];

        foreach ($types as $type) {
            $facility->insert([
                "facility_name" => $type,
            ]);
        }
    }
}
