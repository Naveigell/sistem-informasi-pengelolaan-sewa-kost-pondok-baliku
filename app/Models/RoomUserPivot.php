<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomUserPivot extends Model
{
    protected $table = 'room_user_pivot';

    protected $allowedFields = ['room_id', 'user_id', 'is_active'];

    public function withUser($joinType = '')
    {
        return $this->join('users', 'users.id = room_user_pivot.user_id', $joinType);
    }
}
