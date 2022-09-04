<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantRequestRoom extends Model
{
    protected $table = 'applicant_request_rooms';

    protected $allowedFields = ['room_type_id', 'user_id', 'message', 'total', 'booking_date'];
}
