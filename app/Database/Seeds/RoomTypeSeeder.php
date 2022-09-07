<?php

namespace App\Database\Seeds;

use App\Models\RoomType;
use CodeIgniter\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run()
    {
        $roomType = new RoomType();
        $prices   = [2000000, 1200000, 1000000];

        foreach (range('A', 'C') as $index => $type) {
            $roomType->insert([
                "name"       => "Tipe " . $type,
                "rent_price" => $prices[$index],
            ]);
        }
    }
}
