<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Applicant;

class ApplicantController extends BaseController
{
    public function index()
    {
        $applicants = (new Applicant())->findAll();

        return view('admin/pages/applicant/index', compact('applicants'));
    }

    public function approve($id)
    {
        (new Applicant())->update($id, [
            "is_approved" => 1,
        ]);

        return redirect()->route('admin.applicants.index');
    }

    public function reject($id)
    {
        (new Applicant())->update($id, [
            "is_approved" => -1,
        ]);

        return redirect()->route('admin.applicants.index');
    }
}
