<?php

namespace App\Models;

use CodeIgniter\Model;

class Applicant extends Model
{
    protected $table = 'applicants';

    protected $allowedFields = ['name', 'email', 'job', 'phone', 'address', 'message', 'is_approved'];
}
