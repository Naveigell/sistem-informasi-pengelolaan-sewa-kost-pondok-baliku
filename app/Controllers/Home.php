<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {

    }

    public function template()
    {
        return view('layouts/admin/admin');
    }
}
