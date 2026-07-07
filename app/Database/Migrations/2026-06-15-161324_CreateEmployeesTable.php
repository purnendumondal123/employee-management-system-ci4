<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeesTable extends Migration
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

            'employee_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'mobile' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],

            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'department' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'designation' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'salary' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],

            'joining_date' => [
                'type' => 'DATE',
                'null' => true,
            ],

            'dob' => [
                'type' => 'DATE',
                'null' => true,
            ],

            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'profile_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            // Admin / Employee
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'employee'],
                'default'    => 'employee',
            ],

            // Email Verification
            'email_verified' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],

            // Active / Inactive
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
            ],

            // Audit Columns
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            // Soft Delete
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('employee_code');

        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
