<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantRequestRoomPayment extends Model
{
    protected $table = 'applicant_request_room_payments';

    const STATUS_UNVERIFIED = 'unverified';
    const STATUS_PAID_OFF   = 'paid off';
    const STATUS_REJECTED   = 'rejected';

    protected $allowedFields = ['room_id', 'user_id', 'payment_date', 'proof', 'status'];
}
