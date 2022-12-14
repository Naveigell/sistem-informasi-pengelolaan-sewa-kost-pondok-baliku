<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomFacilitiesTable extends Migration
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
            'facility_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'facility_price' => [
                'type' => 'INT',
                'constraint' => 255,
            ],
            'is_disabled' => [
                'type' => 'INT',
                'constraint' => 20,
                'default' => 0,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('room_facilities');
    }

    public function down()
    {
        $this->forge->dropTable('room_facilities');
    }
}
