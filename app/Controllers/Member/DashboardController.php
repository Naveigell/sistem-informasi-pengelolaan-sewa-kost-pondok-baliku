<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('member/dashboard/index');
    }
}
