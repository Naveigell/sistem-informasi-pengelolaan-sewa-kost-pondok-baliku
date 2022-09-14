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
                "month_total"         => 1,
            ],
            [
                "name"                => '6 Bulan',
                "discount_in_percent" => 3,
                "month_total"         => 6,
            ],
            [
                "name"                => '1 Tahun',
                "discount_in_percent" => 5,
                "month_total"         => 12,
            ],
        ];

        foreach ($durations as $duration) {
            $roomRentDuration->insert($duration);
        }
    }
}
