<?php

namespace App\Database\Seeds;

use App\Models\Room;
use App\Models\RoomUserPivot;
use App\Models\User;
use CodeIgniter\Database\Seeder;

class RoomUserPivotSeeder extends Seeder
{
    public function run()
    {
        $users  = (new User())->whereNotAdmin()->findAll();
        $rooms  = (new Room())->findAll();
        $pivot  = new RoomUserPivot();

        foreach ($rooms as $index => $room) {
            $pivot->insert([
                "room_id"   => $room['id'],
                "user_id"   => $users[$index]['id'],
                "is_active" => 1,
            ]);
        }
    }
}
