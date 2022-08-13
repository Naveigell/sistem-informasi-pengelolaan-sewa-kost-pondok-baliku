<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomsTable extends Migration
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
            'room_type_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'room_rent_duration_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'room_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('room_type_id', 'room_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('room_rent_duration_id', 'room_rent_durations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rooms');
    }

    public function down()
    {
        $this->forge->dropTable('rooms');
    }
}
