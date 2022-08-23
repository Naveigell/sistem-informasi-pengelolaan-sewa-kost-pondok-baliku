<?php

namespace App\Controllers\Anonymous;

use App\Controllers\BaseController;

class LandingPageController extends BaseController
{
    public function index()
    {
        return view('anonymous/index');
    }
}
