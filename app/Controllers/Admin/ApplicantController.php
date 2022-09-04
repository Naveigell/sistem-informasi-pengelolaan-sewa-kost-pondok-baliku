<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Applicant;
use App\Models\ApplicantFacility;
use App\Models\ApplicantRequestRoom;
use App\Models\ApplicantRequestRoomPayment;
use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomFacilityPivot;
use App\Models\RoomUserPivot;
use App\Models\User;

class ApplicantController extends BaseController
{
    public function index()
    {
        $bookings = (new ApplicantRequestRoom())->findAll();

        return view('admin/pages/applicant/index', compact('bookings'));
    }


    public function approve($bookingId)
    {
        $booking = (new ApplicantRequestRoom())->where('id', $bookingId)->first();

        // find all room with same type
        $rooms         = (new Room())->where('room_type_id', $booking['room_type_id'])->findAll();
        $roomIds       = array_column($rooms, 'id');

        $roomUserPivot = null;

        $message = 'Berhasil menyetujui';

        if (count($roomIds) > 0) {
            // find the empty room
            $roomUserPivot = (new RoomUserPivot())->whereIn('room_id', $roomIds)->where('user_id IS NULL')->first();

            // all facilities
            $facilities    = (new RoomFacility())->findAll();
            $facilitiesIds = array_column($facilities, 'id');

            if ($roomUserPivot) {
                (new RoomFacilityPivot())->builder()->where('room_id', $roomUserPivot['room_id'])->delete();
                (new RoomUserPivot())->builder()->where('room_id', $roomUserPivot['room_id'])->update([
                    "user_id" => $booking['user_id'],
                ]);

                // request facilities
                $requestFacilities    = (new ApplicantFacility())->where('applicant_request_room_id', $bookingId)->findAll();
                $requestFacilitiesIds = array_column($requestFacilities, 'room_facility_id');

                $facilityBatches = [];

                foreach ($facilitiesIds as $facilitiesId) {
                    $facilityBatches[] = [
                        "room_id"     => $roomUserPivot['room_id'],
                        "facility_id" => $facilitiesId,
                        "is_active"   => in_array($facilitiesId, $requestFacilitiesIds),
                    ];
                }

                (new RoomFacilityPivot())->insertBatch($facilityBatches);

                (new ApplicantRequestRoomPayment())->builder()->where('room_id', $booking['id'])
                                                    ->update([
                                                        "status" => ApplicantRequestRoomPayment::STATUS_PAID_OFF,
                                                    ]);

                (new User())->builder()->where('id', $booking['user_id'])->update([
                    "role" => User::ROLE_MEMBER,
                ]);
            } else {
                return redirect()->route('admin.applicants.index')->with('failed', 'Tidak ada ruangan kosong yang ditemukan');
            }
        }

        return redirect()->route('admin.applicants.index')->with('success', 'Berhasil menyetujui pelamar');
    }

    public function reject($id)
    {
        $booking = (new ApplicantRequestRoom())->where('id', $id)->first();

        (new ApplicantRequestRoomPayment())->builder()->where('room_id', $booking['id'])
                                           ->update([
                                                 "status" => ApplicantRequestRoomPayment::STATUS_REJECTED,
                                           ]);

        return redirect()->route('admin.applicants.index');
    }
}
