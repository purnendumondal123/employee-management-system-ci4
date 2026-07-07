<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivityLogsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'employee_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'activity' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addKey('employee_id');

        $this->forge->addForeignKey(
            'employee_id',
            'employees',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('activity_logs');
    }

    public function down()
    {
        $this->forge->dropTable('activity_logs');
    }
}
