<?php

namespace App\Controllers\Anonymous;

use App\Controllers\BaseController;

class RoomController extends BaseController
{
    public function roomA()
    {
        return view('anonymous/roomA');
    }

    public function roomB()
    {
        return view('anonymous/roomB');
    }

    public function roomC()
    {
        return view('anonymous/roomC');
    }
}
