<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'username' => [
                'rules' => 'required',
            ],
            'password' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect('login.index')->withInput()->with('errors', $validator->getErrors());
        }

        $user = (object) (new User())->where('username', $this->request->getVar('username'))->first();
        if (!$user || !property_exists($user, 'id')) {
            $validator->setError('auth', 'User not found');

            return redirect()->route('login.index')->withInput()->with('errors', $validator->getErrors());
        }

        if (!password_verify($this->request->getVar('password'), $user->password)) {
            $validator->setError('auth', 'Password wrong');

            return redirect()->route('login.index')->withInput()->with('errors', $validator->getErrors());
        }

        session()->set('user', $user);
        session()->set('hasLoggedIn', true);

        if ($user->role == User::ROLE_ADMIN) {
            return redirect()->route('admin.dashboards.index');
        }

        return redirect()->route('member.dashboards.index');
    }
}
