<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Complaint;
use App\Models\Payment;
use App\Models\RoomUserPivot;

class DashboardController extends BaseController
{
    public function index()
    {
        $compaintCount  = (new Complaint())->where('user_id', session()->get('user')->id)
                                           ->where('status', Complaint::STATUS_ON_PROGRESS)
                                           ->countAllResults();

        $payment = (new Payment())->where('user_id', session()->get('user')->id)->where('MONTH(payment_date)', date('j') - 1)->where('status', Payment::STATUS_PAID_OFF)->first();

        return view('member/pages/dashboard/index', compact('payment', 'compaintCount'));
    }
}
