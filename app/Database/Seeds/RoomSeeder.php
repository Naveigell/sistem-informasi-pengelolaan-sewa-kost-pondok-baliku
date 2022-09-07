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

            if ($i >= 13) {
                $roomTypeId = $roomTypes[0]['id'];
            } elseif ($i >= 4) {
                $roomTypeId = $roomTypes[1]['id'];
            } else {
                $roomTypeId = $roomTypes[2]['id'];
            }

            $roomTypeIndex = array_search($roomTypeId, array_column($roomTypes, 'id'));

            $room->insert([
                "room_type_id"          => $roomTypeId,
                "room_rent_duration_id" => $roomRentDurations[array_rand($roomRentDurations)]['id'],
                "room_number"           => str_pad($i, 2, '0', STR_PAD_LEFT),
                "price"                 => $roomTypes[$roomTypeIndex]['rent_price'],
            ]);
        }
    }
}
