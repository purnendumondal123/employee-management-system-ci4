<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class DashboardController extends BaseController
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {
        $data['totalEmployees'] = $this->employeeModel->countAll();

        $data['activeEmployees'] = $this->employeeModel
            ->where('status', 'active')
            ->countAllResults();

        $data['inactiveEmployees'] = (new EmployeeModel())
            ->where('status', 'inactive')
            ->countAllResults();

        $data['verifiedEmployees'] = (new EmployeeModel())
            ->where('email_verified', 1)
            ->countAllResults();

        $data['recentEmployees'] = (new EmployeeModel())
            ->orderBy('id', 'DESC')
            ->findAll(5);

        return view('dashboard/index', $data);
    }
}