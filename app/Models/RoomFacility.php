<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomFacility extends Model
{
    protected $table = 'room_facilities';

    protected $allowedFields = ['facility_name', 'facility_price', 'is_disabled'];
}
