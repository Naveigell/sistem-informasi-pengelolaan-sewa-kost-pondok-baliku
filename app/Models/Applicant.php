<?php

namespace App\Models;

use CodeIgniter\Model;

class Applicant extends Model
{
    protected $table = 'applicants';

    protected $allowedFields = ['name', 'username', 'email', 'password', 'job', 'identity_card', 'phone', 'address', 'is_approved'];
}
