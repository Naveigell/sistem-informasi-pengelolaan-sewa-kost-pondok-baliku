<?php

namespace App\Controllers\Applicant;

use App\Controllers\BaseController;
use App\Models\ApplicantFacility;
use App\Models\ApplicantRequestRoom;
use App\Models\ApplicantRequestRoomPayment;
use App\Models\RoomFacility;
use App\Models\RoomType;

class PaymentController extends BaseController
{
    public function index()
    {
        $bookings = (new ApplicantRequestRoom())->where('user_id', session()->get('user')->id)->findAll();

        return view('applicant/pages/payment/index', compact('bookings'));
    }

    public function create($bookingId)
    {
        $booking           = (new ApplicantRequestRoom())->where('id', $bookingId)->first();
        $roomType          = (new RoomType())->where('id', $booking['room_type_id'])->first();
        $requestFacilities = (new ApplicantFacility())->where('applicant_request_room_id', $bookingId)->findAll();
        $facilities        = [];

        if (count($requestFacilities) > 0) {
            $ids = array_map(function ($facility) {
                return $facility['room_facility_id'];
            }, $requestFacilities);

            $facilities = (new RoomFacility())->whereIn('id', $ids)->findAll();
        }

        return view('applicant/pages/payment/form', compact('bookingId', 'booking', 'roomType', 'facilities'));
    }

    public function store($bookingId)
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'proof' => [
                'rules' => 'uploaded[proof]|mime_in[proof,image/png,image/jpg,image/jpeg]',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('proof');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/payments', $imageName);

        (new ApplicantRequestRoomPayment())->insert([
            "room_id"      => $bookingId,
            "user_id"      => session()->get('user')->id,
            "payment_date" => date('Y-m-d'),
            "proof"        => $imageName,
            "status"       => ApplicantRequestRoomPayment::STATUS_UNVERIFIED,
        ]);

        return redirect()->route('applicant.payments.index')->with('success', 'Berhasil melakukan pendaftaran, silakan menunggu');
    }
}
