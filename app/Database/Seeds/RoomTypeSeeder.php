<?php

namespace App\Database\Seeds;

use App\Models\RoomType;
use CodeIgniter\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run()
    {
        $roomType = new RoomType();

        foreach (range('A', 'C') as $type) {
            $roomType->insert([
                "name" => "Tipe " . $type,
            ]);
        }
    }
}
