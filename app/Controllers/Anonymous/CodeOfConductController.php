<?php

namespace App\Controllers\Anonymous;

use App\Controllers\BaseController;

class CodeOfConductController extends BaseController
{
    public function index()
    {
        return view('anonymous/code_of_conduct');
    }
}
