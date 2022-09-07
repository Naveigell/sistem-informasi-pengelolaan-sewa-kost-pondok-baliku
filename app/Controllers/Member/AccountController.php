<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Biodata;
use App\Models\User;

class AccountController extends BaseController
{
    public function index()
    {
        $biodata = (new Biodata())->where('user_id', session()->get('user')->id)->first();
        $user    = (new User())->where('id', session()->get('user')->id)->first();

        return view('member/pages/account/index', compact('biodata', 'user'));
    }

    public function update()
    {
        $identityCardPhoto = $this->request->getFile('identity_card');

        $rules = [
            'name' => [
                'rules' => 'required',
            ],
            'job' => [
                'rules' => 'required',
            ],
            'phone' => [
                'rules' => 'required',
            ],
            'address' => [
                'rules' => 'required',
            ],
            'password' => [
                'rules' => 'permit_empty',
            ],
        ];

        if ($identityCardPhoto->isFile()) {
            $rules['identity_card'] = [
                'rules' => 'uploaded[identity_card]|mime_in[identity_card,image/png,image/jpg,image/jpeg]',
            ];
        }

        $validator = \Config\Services::validation();
        $validator->setRules($rules);

        if (!$validator->run($this->request->getVar())) {
            return redirect('applicant.accounts.index')->withInput()->with('biodata-errors', $validator->getErrors());
        }

        if ($identityCardPhoto->isFile()) {
            $image     = $this->request->getFile('identity_card');
            $imageName = str_random(40) . '.' . $image->getClientExtension();

            $image->move(ROOTPATH . 'public/uploads/images/occupants', $imageName);

            (new Biodata())->builder()->where('user_id', session()->get('user')->id)->update(["identity_card" => $imageName]);
        }

        (new User())->builder()->where('id', session()->get('user')->id)->update($this->request->getVar(['name']));
        (new Biodata())->builder()->where('user_id', session()->get('user')->id)->update(
            array_merge($this->request->getVar(['job', 'phone', 'address']), [
                "has_filled_biodata" => 1,
            ])
        );

        $user = (object) (new User())->where('id', session()->get('user')->id)->first();

        session()->set('user', $user);

        return redirect('member.accounts.index')->withInput()->with('biodata-success', 'Berhasil mengubah biodata');
    }
}
