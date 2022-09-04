<?php

namespace App\Controllers\Applicant;

use App\Controllers\BaseController;
use App\Models\ApplicantFacility;
use App\Models\ApplicantRequestRoom;
use App\Models\RoomFacility;
use App\Models\RoomType;

class BookingController extends BaseController
{
    public function index()
    {
        $roomTypes      = (new RoomType())->findAll();
        $roomFacilities = (new RoomFacility())->findAll();

        return view('applicant/pages/booking/index', compact('roomTypes', 'roomFacilities'));
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "room_type" => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $requestRoom = (new ApplicantRequestRoom());
        $requestRoom->insert(array_merge($this->request->getVar(), [
            "user_id"      => session()->get('user')->id,
            "room_type_id" => $this->request->getVar('room_type'),
            "booking_date" => date('Y-m-d'),
        ]));

        if (is_array($this->request->getVar('facilities'))) {

            $facilities = [];

            foreach ($this->request->getVar('facilities') as $facility) {
                $facilities[] = [
                    "user_id" => session()->get('user')->id,
                    "applicant_request_room_id" => $requestRoom->getInsertID(),
                    "room_facility_id"          => $facility,
                ];
            }

            (new ApplicantFacility())->insertBatch($facilities);
        }

        return redirect()->route('applicant.payments.create', [$requestRoom->getInsertID()]);
    }
}
