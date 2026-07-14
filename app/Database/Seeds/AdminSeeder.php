<?php

namespace App\Database\Seeds;

use App\Models\EmployeeModel;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $employee = new EmployeeModel();
        $data = [
            'employee_code'   => 'EMP-0001',
            'first_name'      => 'Admin',
            'last_name'       => 'User',
            'email'           => 'admin@example.com',
            'mobile'          => '9876543210',
            'password'        => 'Admin@123',
            'role'            => 'admin',
            'email_verified'  => 1,
            'status'          => 'active',
        ];

        // $this->db->table('employees')->insert($data);
        $employee->insert($data);
    }
}
