<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Payment;

class PaymentController extends BaseController
{
    public function verficiationIndex()
    {
        $payments = (new Payment())->where('status', Payment::STATUS_UNVERIFIED)->findAll();

        return view('admin/pages/payment/verification/index', compact('payments'));
    }

    public function verficiationUpdate($paymentId)
    {
        if (!in_array($this->request->getVar('status'), [1, 0])) {
            return redirect()->back();
        }

        (new Payment())->update($paymentId, [
            "status" => $this->request->getVar('status') == 1 ? Payment::STATUS_PAID_OFF : Payment::STATUS_REJECTED,
            "reply"  => $this->request->getVar('reply') ?: null,
        ]);

        return redirect()->route('admin.payments.verifications.index');
    }

    public function historyIndex()
    {
        $payments = (new Payment())->whereNotIn('status', [Payment::STATUS_UNVERIFIED]);

        if (@$_GET['sort']) {
            $payments = $payments->orderBy('room_id', $_GET['sort']);
        }

        $payments = $payments->findAll();

        return view('admin/pages/payment/history/index', compact('payments'));
    }
}
