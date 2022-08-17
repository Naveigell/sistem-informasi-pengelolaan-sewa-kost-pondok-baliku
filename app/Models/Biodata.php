<?php

namespace App\Models;

use CodeIgniter\Model;

class Biodata extends Model
{
    protected $table = 'biodatas';

    protected $allowedFields = ['user_id', 'job', 'identity_card', 'phone', 'address'];
}
