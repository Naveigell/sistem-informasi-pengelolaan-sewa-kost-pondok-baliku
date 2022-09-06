<?php

namespace App\Controllers\Anonymous;

use App\Controllers\BaseController;
use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomUserPivot;

class RoomController extends BaseController
{
    public function roomA()
    {
        $rooms      = $this->emptyRooms(1);
        $facilities = $this->facilities();

        return view('anonymous/roomA', compact('rooms', 'facilities'));
    }

    public function roomB()
    {
        $rooms      = $this->emptyRooms(2);
        $facilities = $this->facilities();

        return view('anonymous/roomB', compact('rooms', 'facilities'));
    }

    public function roomC()
    {
        $rooms      = $this->emptyRooms(3);
        $facilities = $this->facilities();

        return view('anonymous/roomC', compact('rooms', 'facilities'));
    }

    private function facilities()
    {
        return (new RoomFacility())->findAll();
    }

    private function emptyRooms($typeId)
    {
        $rooms = (new Room())->where('room_type_id', $typeId)->findAll();
        $ids   = array_column($rooms, 'id');

        $pivot   = (new RoomUserPivot())->whereIn('room_id', $ids)->where('user_id IS NULL')->findAll();

        $roomIds = array_map(function ($room) {
            return $room['room_id'];
        }, $pivot);

        if (count($roomIds) <= 0) {
            return [];
        }

        return (new Room())->whereIn('id', $roomIds)->findAll();
    }
}
