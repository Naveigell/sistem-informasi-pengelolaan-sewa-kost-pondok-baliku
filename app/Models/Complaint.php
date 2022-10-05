<?php

namespace App\Models;

use CodeIgniter\Model;

class Complaint extends Model
{
    protected $table = 'complaints';

    const STATUS_ON_PROGRESS = 'on progress';
    const STATUS_FINISHED    = 'finished';
    const STATUS_REJECTED    = 'rejected';

    protected $allowedFields = ['room_id', 'user_id', 'complaint_date', 'proof', 'description', 'reply', 'status', 'approved_by_member'];
}
