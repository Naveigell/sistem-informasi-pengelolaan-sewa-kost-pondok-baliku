<?php

namespace App\Database\Seeds;

use App\Models\RoomRentDuration;
use CodeIgniter\Database\Seeder;

class RoomRentDurationSeeder extends Seeder
{
    public function run()
    {
        $roomRentDuration = new RoomRentDuration();
        $durations        = [
            [
                "name"                => '1 Bulan',
                "discount_in_percent" => 0,
            ],
            [
                "name"                => '6 Bulan',
                "discount_in_percent" => 3,
            ],
            [
                "name"                => '1 Tahun',
                "discount_in_percent" => 5,
            ],
        ];

        foreach ($durations as $duration) {
            $roomRentDuration->insert($duration);
        }
    }
}
