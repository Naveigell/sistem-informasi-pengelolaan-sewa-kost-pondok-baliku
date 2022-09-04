<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApplicantRequestRoomPaymentsTable extends Migration
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
            'room_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => true,
            ],
            'payment_date' => [
                'type' => 'DATE',
            ],
            'proof' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('room_id', 'applicant_request_rooms', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('applicant_request_room_payments');
    }

    public function down()
    {
        $this->forge->dropTable('applicant_request_room_payments');
    }
}
