<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomRentDurationsTable extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('room_rent_durations');
    }

    public function down()
    {
        $this->forge->dropTable('room_rent_durations');
    }
}
