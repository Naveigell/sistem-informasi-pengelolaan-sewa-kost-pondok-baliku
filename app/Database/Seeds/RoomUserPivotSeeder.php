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
        $users  = (new User())->findAll();
        $rooms  = (new Room())->findAll();
        $pivot  = new RoomUserPivot();

        foreach ($rooms as $room) {
            $active = rand(1, 10) < 5;

            $pivot->insert([
                "room_id"   => $room['id'],
                "user_id"   => $active ? $users[array_rand($users)]['id'] : null,
                "is_active" => $active,
            ]);
        }
    }
}
