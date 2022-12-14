<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Complaint;
use App\Models\Payment;
use App\Models\Room;
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
        $complaintCount         = (new Complaint())->where('status', Complaint::STATUS_ON_PROGRESS)->countAllResults();

        $payments = (new Payment())->where('MONTH(payment_date)', date('m') + 1)->findAll();
        $roomIds  = array_column($payments, 'room_id');
        $rooms    = [];

        if (count($roomIds) > 0) {
            $rooms = (new Room())->whereNotIn('id', $roomIds)->findAll();
        } else {
            $rooms = (new Room())->findAll();
        }

        return view('admin/pages/dashboard/index', compact('activeMemberCount', 'emptyRoomCount', 'applicantCount', 'unverifiedPaymentCount', 'complaintCount', 'rooms'));
    }
}
