<?php

namespace App\Controllers\Anonymous;

use App\Controllers\BaseController;
use App\Models\Room;
use App\Models\RoomUserPivot;

class RoomController extends BaseController
{
    public function roomA()
    {
        $rooms = $this->emptyRooms();

        return view('anonymous/roomA', compact('rooms'));
    }

    public function roomB()
    {
        $rooms = $this->emptyRooms();

        return view('anonymous/roomB', compact('rooms'));
    }

    public function roomC()
    {
        $rooms = $this->emptyRooms();

        return view('anonymous/roomC', compact('rooms'));
    }

    private function emptyRooms()
    {
        $pivot   = (new RoomUserPivot())->where('user_id IS NULL')->findAll();

        $roomIds = array_map(function ($room) {
            return $room['room_id'];
        }, $pivot);

        if (count($roomIds) <= 0) {
            return [];
        }

        return (new Room())->whereIn('id', $roomIds)->findAll();
    }
}
