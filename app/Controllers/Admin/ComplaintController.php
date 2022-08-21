<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Complaint;

class ComplaintController extends BaseController
{
    public function index()
    {
        $complaints = (new Complaint())->findAll();

        return view('admin/pages/complaint/index', compact('complaints'));
    }

    public function update($complaintId)
    {
        (new Complaint())->update($complaintId, [
            "status" => Complaint::STATUS_FINISHED,
        ]);

        return redirect()->route('admin.complaints.index')->with('success', 'Status berhasil diubah');
    }
}
