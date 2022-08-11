<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo 'Halo : ' . session()->get('user')->username . '<br/>';
        echo 'Anda login sebagai : ' . session()->get('user')->role . '<br/>';
        echo '<a href="' . route_to('logout') . '">Logout</a>';
    }
}
