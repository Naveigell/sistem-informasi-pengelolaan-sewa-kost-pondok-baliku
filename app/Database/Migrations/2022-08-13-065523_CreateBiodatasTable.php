<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBiodatasTable extends Migration
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
            'job' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'identity_card' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'has_filled_biodata' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('biodatas');
    }

    public function down()
    {
        $this->forge->dropTable('biodatas');
    }
}
