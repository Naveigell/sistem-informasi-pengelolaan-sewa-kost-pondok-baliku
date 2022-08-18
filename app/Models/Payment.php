<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model
{
    protected $table = 'payments';

    const STATUS_UNVERIFIED = 'unverified';
    const STATUS_PAID_OFF   = 'paid off';

    protected $allowedFields = ['room_id', 'user_id', 'payment_date', 'proof', 'description', 'status'];
}
