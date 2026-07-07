<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class ProfileController extends BaseController
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {
        $id = session()->get('id'); // logged-in user id

        $data['user'] = $this->employeeModel->find($id);

        return view('profile/index', $data);
    }

    public function update()
    {
        $id = session()->get('id');

        $this->employeeModel->update($id, [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'mobile'     => $this->request->getPost('mobile'),
        ]);

        return redirect()->to('/profile')->with('success', 'Profile updated');
    }

    public function uploadPhoto()
    {
        $id = session()->get('id');

        $file = $this->request->getFile('profile_photo');

        if ($file->isValid() && !$file->hasMoved()) {

            $newName = $file->getRandomName();
            $file->move('uploads/profile', $newName);

            $this->employeeModel->update($id, [
                'profile_photo' => $newName
            ]);
        }

        return redirect()->to('/profile')->with('success', 'Photo updated');
    }
}