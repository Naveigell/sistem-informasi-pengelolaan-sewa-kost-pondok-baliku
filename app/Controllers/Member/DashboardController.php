<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\RoomUserPivot;

class DashboardController extends BaseController
{
    public function index()
    {
        $emptyRoomCount = (new RoomUserPivot())->where('user_id IS NULL')->countAllResults();

        return view('member/pages/dashboard/index', compact('emptyRoomCount'));
    }
}
