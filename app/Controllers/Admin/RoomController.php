<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomFacilityPivot;
use App\Models\RoomRentDuration;
use App\Models\RoomType;
use App\Models\RoomUserPivot;
use App\Models\User;

class RoomController extends BaseController
{
    public function index()
    {
        $rooms               = (new Room())->orderBy('room_number')->findAll();
        $availableUsers      = (new User())->whereNotAdmin()->findAll();
        $availableFacilities = (new RoomFacility())->findAll();
        $roomTypes           = (new RoomType())->findAll();
        $roomRentDurations   = (new RoomRentDuration())->findAll();

        return view('admin/pages/room/index', compact('rooms', 'availableUsers', 'roomTypes', 'roomRentDurations', 'availableFacilities'));
    }

    public function update($roomId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            render_json(422, $validator->getErrors());
        } else {
            $availableFacilities = (new RoomFacility())->findAll();
            $pivotFacilities     = [];
            $facilities          = $this->request->getVar('facilities');

            foreach ($availableFacilities as $availableFacility) {

                $index = array_search($availableFacility['id'], $facilities ?? []);

                $pivotFacilities[] = [
                    "room_id"     => $roomId,
                    "facility_id" => $availableFacility['id'],
                    "is_active"   => is_int($index),
                ];
            }

            (new RoomFacilityPivot())->where('room_id', $roomId)->delete();
            (new RoomFacilityPivot())->insertBatch($pivotFacilities);

            (new Room())->update($roomId, $this->request->getVar());

            $user = (new \App\Models\RoomUserPivot())->withUser('LEFT')
                    ->select('*, room_user_pivot.id AS room_user_pivot_id')
                    ->where('room_id', $roomId)
                    ->orderBy('room_user_pivot.id', 'DESC')
                    ->first();

            if ($this->request->getVar('user_id')) {
                (new RoomUserPivot())->update($user['room_user_pivot_id'], ["user_id" => $this->request->getVar('user_id')]);
            } else {
                (new RoomUserPivot())->update($user['room_user_pivot_id'], ["user_id" => null]);
            }

            render_json(204);
        }
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'room_type_id' => [
                'rules' => 'required',
            ],
            'room_rent_duration_id' => [
                'rules' => 'required',
            ],
            'room_number' => [
                'rules' => 'required',
            ],
            'price' => [
                'rules' => 'required',
            ],
        ]);

        return $validator;
    }

}
