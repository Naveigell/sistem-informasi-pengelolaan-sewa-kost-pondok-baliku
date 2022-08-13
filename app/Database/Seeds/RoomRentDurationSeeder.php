<?php

namespace App\Database\Seeds;

use App\Models\RoomRentDuration;
use CodeIgniter\Database\Seeder;

class RoomRentDurationSeeder extends Seeder
{
    public function run()
    {
        $roomRentDuration = new RoomRentDuration();
        $durations        = ['1 Bulan', '6 Bulan', '1 Tahun'];

        foreach ($durations as $duration) {
            $roomRentDuration->insert([
                "name" => $duration,
            ]);
        }
    }
}
