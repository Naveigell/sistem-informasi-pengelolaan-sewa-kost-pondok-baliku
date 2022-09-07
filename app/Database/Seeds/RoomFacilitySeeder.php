<?php

namespace App\Database\Seeds;

use App\Models\RoomFacility;
use CodeIgniter\Database\Seeder;

class RoomFacilitySeeder extends Seeder
{
    public function run()
    {
        $facility = new RoomFacility();
        $types    = [
            'Dapur & Kamar Mandi Dalam', 'Water Heater', 'Lemari', 'Kasur', 'TV', 'AC'
        ];

        $types = [
            [
                "name"        => "Dapur & Kamar Mandi Dalam",
                "price"       => 0,
                "is_disabled" => 1,
            ],
            [
                "name"  => "Water Heater",
                "price" => 200000,
            ],
            [
                "name"  => "Lemari",
                "price" => 100000,
            ],
            [
                "name"  => "Kasur",
                "price" => 150000,
            ],
            [
                "name"  => "TV",
                "price" => 15000,
            ],
            [
                "name"        => "AC",
                "price"       => 200000,
                "is_disabled" => 1,
            ],
        ];

        foreach ($types as $type) {
            $facility->insert([
                "facility_name"  => $type['name'],
                "facility_price" => $type['price'],
                "is_disabled"    => array_key_exists('is_disabled', $type),
            ]);
        }
    }
}
