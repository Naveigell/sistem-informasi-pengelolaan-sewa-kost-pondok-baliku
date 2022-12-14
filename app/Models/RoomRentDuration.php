<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomRentDuration extends Model
{
    protected $table = 'room_rent_durations';

    protected $allowedFields = ['name', 'discount_in_percent', 'month_total'];
}
