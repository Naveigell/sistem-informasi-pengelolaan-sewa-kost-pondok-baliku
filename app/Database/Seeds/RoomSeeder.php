<?php

namespace App\Database\Seeds;

use App\Models\Room;
use App\Models\RoomRentDuration;
use App\Models\RoomType;
use CodeIgniter\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $room              = new Room();
        $roomTypes         = (new RoomType())->findAll();
        $roomRentDurations = (new RoomRentDuration())->findAll();

        for ($i = 1; $i <= 15; $i++) {
            $room->insert([
                "room_type_id"          => $roomTypes[array_rand($roomTypes)]['id'],
                "room_rent_duration_id" => $roomRentDurations[array_rand($roomRentDurations)]['id'],
                "room_number"           => str_pad($i, 2, '0', STR_PAD_LEFT),
                "price"                 => rand(4, 6) * pow(10, rand(5, 6)),
            ]);
        }
    }
}
