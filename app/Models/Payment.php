<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model
{
    protected $table = 'payments';

    const STATUS_UNVERIFIED = 'unverified';
    const STATUS_PAID_OFF   = 'paid off';
    const STATUS_REJECTED   = 'rejected';

    const TYPE_CASH     = 'cash';
    const TYPE_TRANSFER = 'transfer';

    protected $allowedFields = ['room_id', 'user_id', 'payment_date', 'payment_type', 'proof', 'description', 'reply', 'status'];
}
