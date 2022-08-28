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
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'job' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'message' => [
                'type' => 'TEXT',
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
