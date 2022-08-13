<?php

namespace App\Models;

use CodeIgniter\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $allowedFields = ['room_type_id', 'room_rent_duration_id', 'room_number', 'price'];
}
