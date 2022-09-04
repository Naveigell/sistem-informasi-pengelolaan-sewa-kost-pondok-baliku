<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Applicant;
use App\Models\Biodata;
use App\Models\User;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('auth/register');
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'name' => [
                'rules' => 'required',
            ],
            'username' => [
                'rules' => 'required',
            ],
            'email' => [
                'rules' => 'required',
            ],
            'password' => [
                'rules' => 'required',
            ],
            'phone' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->route('register.index')->withInput()->with('errors', $validator->getErrors());
        }

        try {

            $user = new User();
            $user->insert(array_merge($this->request->getVar(), [
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role'     => User::ROLE_APPLICANT,
            ]));

            (new Biodata())->insert(array_merge($this->request->getVar(), [
                "user_id" => $user->getInsertID(),
            ]));

        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('login.index')->withInput()->with('success', 'Register berhasil, silakan melakukan login');
    }
}
