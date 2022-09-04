<?php

namespace App\Database\Seeds;

use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomFacilityPivot;
use CodeIgniter\Database\Seeder;

class RoomFacilityPivotSeeder extends Seeder
{
    public function run()
    {
        $facilities = (new RoomFacility())->findAll();
        $rooms      = (new Room())->findAll();
        $pivot      = new RoomFacilityPivot();

        foreach ($rooms as $room) {
            foreach ($facilities as $facility) {
                $active = rand(1, 10) < 5;

                $pivot->insert([
                    "room_id"     => $room['id'],
                    "facility_id" => $facility['id'],
                    "is_active"   => $active,
                ]);
            }
        }
    }
}
