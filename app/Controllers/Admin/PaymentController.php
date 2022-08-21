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
        if (!in_array($this->request->getVar('status'), [Payment::STATUS_PAID_OFF, Payment::STATUS_REJECTED])) {
            return redirect()->back();
        }

        (new Payment())->update($paymentId, [
            "status" => $this->request->getVar('status'),
        ]);

        return redirect()->route('admin.payments.verifications.index');
    }

    public function historyIndex()
    {
        $payments = (new Payment())->whereNotIn('status', [Payment::STATUS_UNVERIFIED])->findAll();

        return view('admin/pages/payment/history/index', compact('payments'));
    }
}
