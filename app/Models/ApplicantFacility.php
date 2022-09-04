<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantFacility extends Model
{
    protected $table = 'applicant_facility';

    protected $allowedFields = ['user_id', 'applicant_request_room_id', 'room_facility_id'];
}
