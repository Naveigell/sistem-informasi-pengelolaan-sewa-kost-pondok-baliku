<?php

namespace App\Controllers\Anonymous;

use App\Controllers\BaseController;
use App\Models\Applicant;

class ApplicantController extends BaseController
{
    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "name" => [
                'rules' => 'required',
            ],
            "email" => [
                'rules' => 'required',
            ],
            "job" => [
                'rules' => 'required',
            ],
            "phone" => [
                'rules' => 'required',
            ],
            "address" => [
                'rules' => 'required',
            ],
            "message" => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new Applicant())->insert($this->request->getVar());

        return redirect()->back()->with('rent-success', 'Terimakasih sudah memesan kamar, silakan menunggu agar dihubungi admin.');
    }
}
