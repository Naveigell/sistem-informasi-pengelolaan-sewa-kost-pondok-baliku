<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomFacilityPivot;
use App\Models\RoomType;
use App\Models\RoomUserPivot;

class PaymentController extends BaseController
{
    public function index()
    {
        $payments          = (new Payment())->where('user_id', session()->get('user')->id)->findAll();
        $roomUserPivot     = (new RoomUserPivot())->where('user_id', session()->get('user')->id)->orderBy('id', 'DESC')->first();
        $room              = (new Room())->where('id', $roomUserPivot['room_id'])->orderBy('id', 'DESC')->first();
        $roomType          = (new RoomType())->where('id', $room['room_type_id'])->first();
        $roomFacilityPivot = (new RoomFacilityPivot())->where('room_id', $room['id'])->where('is_active', 1)->findAll();
        $facilityPivotIds  = array_map(function ($pivot) {
            return $pivot['facility_id'];
        }, $roomFacilityPivot);

        $facilities = count($facilityPivotIds) > 0 ? (new RoomFacility())->whereIn('id', $facilityPivotIds)->findAll() : [];

        return view('member/payment/index', compact('payments', 'roomUserPivot', 'room', 'roomType', 'roomFacilityPivot', 'facilityPivotIds', 'facilities'));
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'room_id' => [
                'rules' => 'required',
            ],
            'payment_date' => [
                'rules' => 'required|valid_date[Y-m-d]',
            ],
            'description' => [
                'rules' => 'permit_empty',
            ],
            'proof' => [
                'rules' => 'uploaded[proof]|mime_in[proof,image/png,image/jpg,image/jpeg]',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            render_json(422, $validator->getErrors());
        } else {

            $image     = $this->request->getFile('proof');
            $imageName = str_random(40) . '.' . $image->getClientExtension();

            $image->move(ROOTPATH . 'public/uploads/images/payments', $imageName);

            (new Payment())->insert([
                "user_id"      => session()->get('user')->id,
                "room_id"      => $this->request->getVar('room_id'),
                "payment_date" => $this->request->getVar('payment_date'),
                "proof"        => $imageName,
                "description"  => $this->request->getVar('description') ?? null,
                "status"       => Payment::STATUS_UNVERIFIED,
            ]);

            render_json(204);
        }
    }
}
