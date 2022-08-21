<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Complaint;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomUserPivot;

class ComplaintController extends BaseController
{
    public function index()
    {
        $complaints    = (new Complaint())->where('user_id', session()->get('user')->id)->findAll();
        $roomUserPivot = (new RoomUserPivot())->where('user_id', session()->get('user')->id)->orderBy('id', 'DESC')->first();
        $room          = (new Room())->where('id', $roomUserPivot['room_id'])->orderBy('id', 'DESC')->first();
        $roomType      = (new RoomType())->where('id', $room['room_type_id'])->first();

        return view('member/pages/complaint/index', compact('complaints', 'roomUserPivot', 'room', 'roomType'));
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'room_id' => [
                'rules' => 'required',
            ],
            'description' => [
                'rules' => 'required',
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

            $image->move(ROOTPATH . 'public/uploads/images/complaints', $imageName);

            (new Complaint())->insert([
                "user_id"        => session()->get('user')->id,
                "room_id"        => $this->request->getVar('room_id'),
                "complaint_date" => date('Y-m-d'),
                "proof"          => $imageName,
                "description"    => $this->request->getVar('description') ?? null,
                "status"         => Complaint::STATUS_ON_PROGRESS,
            ]);

            render_json(204);
        }
    }
}
