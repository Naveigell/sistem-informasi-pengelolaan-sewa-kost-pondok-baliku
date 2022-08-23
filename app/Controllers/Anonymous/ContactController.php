<?php

namespace App\Controllers\Anonymous;

use App\Controllers\BaseController;

class ContactController extends BaseController
{
    public function index()
    {
        return view('anonymous/contact');
    }
}
