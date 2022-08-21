<?php

namespace App\Models;

use CodeIgniter\Model;

class Complaint extends Model
{
    protected $table = 'complaints';

    const STATUS_ON_PROGRESS = 'on progress';
    const STATUS_FINISHED = 'finished';

    protected $allowedFields = ['room_id', 'user_id', 'complaint_date', 'proof', 'description', 'status'];
}
