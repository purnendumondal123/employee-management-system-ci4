<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeOtpsTable extends Migration
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

            'otp' => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
            ],

            'purpose' => [
                'type'       => 'ENUM',
                'constraint' => ['registration', 'forgot_password'],
            ],

            'expires_at' => [
                'type' => 'DATETIME',
            ],

            'is_used' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
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

        $this->forge->createTable('employee_otps');
    }

    public function down()
    {
        $this->forge->dropTable('employee_otps');
    }
}
