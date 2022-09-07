<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Payment;
use App\Models\RoomUserPivot;
use App\Models\User;

class DashboardController extends BaseController
{
    public function index()
    {
        $activeMemberCount      = (new RoomUserPivot())->where('user_id IS NOT NULL')->countAllResults();
        $emptyRoomCount         = (new RoomUserPivot())->where('user_id IS NULL')->countAllResults();
        $applicantCount         = (new User())->where('role', User::ROLE_APPLICANT)->countAllResults();
        $unverifiedPaymentCount = (new Payment())->where('status', Payment::STATUS_UNVERIFIED)->countAllResults();

        return view('admin/pages/dashboard/index', compact('activeMemberCount', 'emptyRoomCount', 'applicantCount', 'unverifiedPaymentCount'));
    }
}
