<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomFacilityPivot extends Model
{
    protected $table = 'room_facility_pivot';

    protected $allowedFields = ['room_id', 'facility_id', 'is_active'];
}
