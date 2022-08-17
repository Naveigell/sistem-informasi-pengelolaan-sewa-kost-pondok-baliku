<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UsersSeeder');
        $this->call('BiodataSeeder');
        $this->call('RoomTypeSeeder');
        $this->call('RoomRentDurationSeeder');
        $this->call('RoomSeeder');
        $this->call('RoomFacilitySeeder');
        $this->call('RoomFacilityPivotSeeder');
        $this->call('RoomUserPivotSeeder');
    }
}
