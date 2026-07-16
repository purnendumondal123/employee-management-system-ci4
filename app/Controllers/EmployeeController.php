<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class EmployeeController extends BaseController
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    /*
    |--------------------------------------------------------------------------
    | Employee List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['employees'] = $this->employeeModel->paginate();
        $data['pager'] = $this->employeeModel->pager;

        return view('employees/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Create Employee
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('employees/create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store Employee
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $rules = [

            'employee_code' => 'required|min_length[3]|max_length[20]|is_unique[employees.employee_code]',

            'first_name' => 'required|min_length[2]|max_length[50]',

            'last_name' => 'required|min_length[2]|max_length[50]',

            'email' => 'required|valid_email|is_unique[employees.email]',

            'mobile' => 'required|min_length[10]|max_length[15]',

            'password' => 'required|min_length[6]',

            'confirm_password' => 'required|matches[password]',

            'role' => 'required|in_list[admin,employee]',

            'status' => 'required|in_list[active,inactive]',

        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [

            'employee_code' => trim($this->request->getPost('employee_code')),

            'first_name' => trim($this->request->getPost('first_name')),

            'last_name' => trim($this->request->getPost('last_name')),

            'email' => trim($this->request->getPost('email')),

            'mobile' => trim($this->request->getPost('mobile')),

            'password' => $this->request->getPost('password'),

            'role' => $this->request->getPost('role'),

            'status' => $this->request->getPost('status'),

            // Admin creates the account,
            // so email verification is not required.
            'email_verified' => 1,

            'created_by' => session()->get('id'),

        ];

        if (!$this->employeeModel->insert($data)) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Unable to create employee.');
        }

        return redirect()->to('/employees')
            ->with('success', 'Employee created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Employee
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee) {
            return redirect()->to('/employees')
                ->with('error', 'Employee not found.');
        }

        $data['employee'] = $employee;

        return view('employees/edit', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Employee
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee) {

            return redirect()->to('/employees')
                ->with('error', 'Employee not found.');
        }

        $rules = [

            'employee_code' => 'required|min_length[3]|max_length[20]|is_unique[employees.employee_code,id,' . $id . ']',

            'firstname' => 'required|min_length[2]|max_length[50]',

            'lastname' => 'required|min_length[2]|max_length[50]',

            'email' => 'required|valid_email|is_unique[employees.email,id,' . $id . ']',

            'mobile' => 'required|min_length[10]|max_length[15]',

            'role' => 'required',

            'status' => 'required',

        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [

            'employee_code' => $this->request->getPost('employee_code'),

            'first_name' => $this->request->getPost('firstname'),

            'last_name' => $this->request->getPost('lastname'),

            'email' => $this->request->getPost('email'),

            'mobile' => $this->request->getPost('mobile'),

            'role' => $this->request->getPost('role'),

            'status' => $this->request->getPost('status'),

            'updated_by' => session()->get('id'),

        ];

        $this->employeeModel->update($id, $data);

        return redirect()->to('/employees')
            ->with('success', 'Employee updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Employee
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee) {

            return redirect()->to('/employees')
                ->with('error', 'Employee not found.');
        }

        // he not delete her Account
        if ($employee['id'] == session()->get('id')) {

            return redirect()->to('/employees')
                ->with('error', 'You cannot delete your own account.');
        }

        $this->employeeModel->delete($id);

        return redirect()->to('/employees')
            ->with('success', 'Employee deleted successfully.');
    }

}
