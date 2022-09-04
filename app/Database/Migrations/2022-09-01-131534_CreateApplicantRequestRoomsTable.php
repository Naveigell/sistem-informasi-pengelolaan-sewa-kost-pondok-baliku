<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApplicantRequestRoomsTable extends Migration
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
            'room_type_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'total' => [
                'type' => 'BIGINT',
                'constraint' => 20,
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'booking_date' => [
                'type' => 'DATE',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('room_type_id', 'room_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('applicant_request_rooms');
    }

    public function down()
    {
        $this->forge->dropTable('applicant_request_rooms');
    }
}
