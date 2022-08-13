<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomFacilityPivotTable extends Migration
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
            'facility_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'is_active' => [
                'type' => 'INTEGER',
                'constraint' => 255,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('room_id', 'rooms', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('facility_id', 'room_facilities', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('room_facility_pivot');
    }

    public function down()
    {
        $this->forge->dropTable('room_facility_pivot');
    }
}
