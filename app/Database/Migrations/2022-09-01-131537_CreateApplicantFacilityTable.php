<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApplicantFacilityTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'applicant_request_room_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'room_facility_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('applicant_request_room_id', 'applicant_request_rooms', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('room_facility_id', 'room_facilities', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('applicant_facility');
    }

    public function down()
    {
        $this->forge->dropTable('applicant_facility');
    }
}
