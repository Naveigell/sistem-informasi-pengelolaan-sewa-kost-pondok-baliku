<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApplicantsTable extends Migration
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
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
            'is_approved' => [
                'type' => 'INTEGER',
                'constraint' => 255,
                'default' => 0,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('applicants');
    }

    public function down()
    {
        $this->forge->dropTable('applicants');
    }
}
