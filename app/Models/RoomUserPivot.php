<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomUserPivot extends Model
{
    protected $table = 'room_user_pivot';

    protected $allowedFields = ['room_id', 'user_id', 'is_active'];
}
