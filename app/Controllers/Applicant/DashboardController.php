<?php

namespace App\Controllers\Applicant;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('applicant/pages/dashboard/index');
    }
}
