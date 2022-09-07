<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomType extends Model
{
    protected $table = 'room_types';

    protected $allowedFields = ['name', 'rent_price'];
}
