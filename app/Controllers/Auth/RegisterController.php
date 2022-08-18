<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
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
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->route('register.index')->withInput()->with('errors', $validator->getErrors());
        }

        $user = (new User())->where('email', $this->request->getVar('email'))
                            ->orWhere('username', $this->request->getVar('username'))
                            ->first();

        if ($user) {
            $validator->setError('auth', 'User already exists');

            return redirect()->route('register.index')->withInput()->with('errors', $validator->getErrors());
        }

        try {
            (new User())->insert([
                'name'     => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role'     => User::ROLE_MEMBER,
            ]);
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('member.auth.login.index')->withInput()->with('success', 'Register berhasil, silakan melakukan login');
    }
}
