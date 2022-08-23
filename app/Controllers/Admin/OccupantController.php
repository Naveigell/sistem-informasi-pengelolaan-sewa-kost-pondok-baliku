<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Biodata;
use App\Models\User;

class OccupantController extends BaseController
{
    public function index()
    {
        $occupants = (new User())->whereNotAdmin()->findAll();

        return view('admin/pages/occupant/index', compact('occupants'));
    }

    public function update($userId)
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

        if ($identityCardPhoto) {
            $rules['identity_card'] = [
                'rules' => 'uploaded[identity_card]|mime_in[identity_card,image/png,image/jpg,image/jpeg]',
            ];
        }

        $validator = \Config\Services::validation();
        $validator->setRules($rules);

        if (!$validator->run($this->request->getVar())) {
            render_json(422, $validator->getErrors());
        } else {

            if ($identityCardPhoto) {
                $image     = $this->request->getFile('identity_card');
                $imageName = str_random(40) . '.' . $image->getClientExtension();

                $image->move(ROOTPATH . 'public/uploads/images/occupants', $imageName);

                (new Biodata())->builder()->where('user_id', $userId)->update(["identity_card" => $imageName]);
            }

            (new User())->builder()->where('id', $userId)->update($this->request->getVar(['name']));

            if ($this->request->getVar('password')) {
                (new User())->builder()->where('id', $userId)->update([
                    "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ]);
            }

            (new Biodata())->builder()->where('user_id', $userId)
                           ->update($this->request->getVar(['job', 'phone', 'address']));

            render_json(204);
        }

//        render_json(200, $this->request->getFile('identity_card')->getClientName());
    }
}
