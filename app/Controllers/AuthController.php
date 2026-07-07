<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\OtpModel;
use Config\Services;

class AuthController extends BaseController
{
    protected $employeeModel;
    protected $otpModel;

    public function __construct()
    {
        helper(['form', 'url']);

        $this->employeeModel = new EmployeeModel();
        $this->otpModel      = new OtpModel();
    }


    // ------- Registration Page ------


    public function register()
    {
        return view('auth/register');
    }

    /*
    |--------------------------------------------------------------------------
    | Registration Save
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $rules = [

            'employee_code'     => 'required|min_length[3]|max_length[20]|is_unique[employees.employee_code]',

            'firstname'         => 'required|min_length[2]|max_length[50]',

            'lastname'          => 'required|min_length[2]|max_length[50]',

            'email'             => 'required|valid_email|is_unique[employees.email]',

            'mobile'            => 'required|numeric|min_length[10]|max_length[15]',

            'password'          => 'required|min_length[6]',

            'confirm_password'  => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Employee Data
        $employeeData = [

            'employee_code'   => $this->request->getPost('employee_code'),

            'first_name'      => $this->request->getPost('firstname'),

            'last_name'       => $this->request->getPost('lastname'),

            'email'           => $this->request->getPost('email'),

            'mobile'          => $this->request->getPost('mobile'),

            'password'        => $this->request->getPost('password'),

            'role'            => 'employee',

            'email_verified'  => 0,

            'status'          => 'active',
        ];

        // Employee Insert
        $this->employeeModel->insert($employeeData);

        $employeeId = $this->employeeModel->getInsertID();

        // Generate OTP
        $otp = rand(100000, 999999);

        // Save OTP
        $otpData = [

            'employee_id' => $employeeId,

            'otp' => $otp,

            'purpose' => 'registration',

            'expires_at' => date('Y-m-d H:i:s', strtotime('+10 minutes')),

            'is_used' => 0,
        ];

        $this->otpModel->insert($otpData);

        // Send Email
        $email = Services::email();

        $email->setFrom('purnendu.india123@gmail.com', 'CI4_User_Login');

        $email->setTo($employeeData['email']);

        $email->setSubject('Email Verification OTP');

        $email->setMessage("
            <h2>Email Verification</h2>

            <p>Hello <strong>{$employeeData['first_name']}</strong>,</p>

            <p>Your OTP for email verification is:</p>

            <h1 style='color:#0d6efd; letter-spacing:3px;'>{$otp}</h1>

            <p>This OTP will expire in <strong>10 minutes</strong>.</p>

            <br>

            <p>Thank You</p>

            <p><strong>CI4 User Login System</strong></p>
        ");

        if (!$email->send()) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Registration successful but OTP email could not be sent.');
        }

        // Session
        session()->set([
            'verify_employee_id' => $employeeId,
            'verify_email'       => $employeeData['email'],
        ]);

        return redirect()->to('/verify-otp')
            ->with('success', "sent a 6-digit OTP to your registered email. Please enter it below to verify your account.");
    }
    /*
    |--------------------------------------------------------------------------
    | Login Page
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | Login Process
    |--------------------------------------------------------------------------
    */

    public function authenticate()
    {
        $rules = [

            'email' => 'required|valid_email',

            'password' => 'required',

        ];


        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }


        $email = $this->request->getPost('email');

        $password = $this->request->getPost('password');


        $employee = $this->employeeModel
            ->where('email', $email)
            ->first();


        if (!$employee) {

            return redirect()->back()
                ->with('error', 'Invalid Email.');
        }


        if (!password_verify($password, $employee['password'])) {

            return redirect()->back()
                ->with('error', 'Invalid Password.');
        }


        if ($employee['email_verified'] == 0) {

            return redirect()->to('verify-otp')
                ->with('error', 'Please verify your email first.');
        }


        session()->set([
            'id' => $employee['id'],
            'employee_code' => $employee['employee_code'],
            'firstname' => $employee['first_name'],
            'lastname' => $employee['last_name'],
            'email' => $employee['email'],
            'role' => $employee['role'],
            'isLoggedIn' => true,
        ]);


        return redirect()->to('/dashboard');
    }

    /*
|--------------------------------------------------------------------------
| Verify Registration OTP
|--------------------------------------------------------------------------
*/

    public function verifyOtp()
    {
        // OTP Page Open
        if ($this->request->is('get')) {
            return view('auth/verify_otp');
        }

        // Validation
        $rules = [
            'otp' => 'required|numeric|exact_length[6]',
        ];

        if (! $this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Session Check
        $employeeId = session()->get('verify_employee_id');

        if (empty($employeeId)) {

            return redirect()->to('/register')
                ->with('error', 'Session expired. Please register again.');
        }

        $otp = $this->request->getPost('otp');

        // Get Latest OTP
        $otpData = $this->otpModel
            ->where('employee_id', $employeeId)
            ->where('purpose', 'registration')
            ->where('is_used', 0)
            ->orderBy('id', 'DESC')
            ->first();

        if (!$otpData) {

            return redirect()->back()
                ->with('error', 'OTP not found.');
        }

        // Expire Check
        if (strtotime($otpData['expires_at']) < time()) {

            return redirect()->back()
                ->with('error', 'OTP has expired.');
        }

        // OTP Match
        if ($otp != $otpData['otp']) {

            return redirect()->back()
                ->with('error', 'Invalid OTP.');
        }

        // Verify Employee
        $this->employeeModel->update($employeeId, [
            'email_verified' => 1
        ]);

        // Mark OTP Used
        $this->otpModel->update($otpData['id'], [
            'is_used' => 1
        ]);

        // Remove Session
        session()->remove([
            'verify_employee_id',
            'verify_email'
        ]);

        // Redirect Login
        return redirect()->to('/')
            ->with('success', 'Email verified successfully. Please login.');
    }

    /*
|--------------------------------------------------------------------------
| Forgot Password Page
|--------------------------------------------------------------------------
*/

    public function forgotPassword()
    {
        if ($this->request->getMethod() == 'GET') {
            return view('auth/forgot_password');
        }

        return redirect()->back();
    }


    /*
    |--------------------------------------------------------------------------
    | Send Forgot Password OTP
    |--------------------------------------------------------------------------
    */

    public function sendForgotOtp()
    {
        // Validation
        $rules = [
            'email' => 'required|valid_email',
        ];

        if (! $this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Get Email
        $email = $this->request->getPost('email');

        // Check Employee
        $employee = $this->employeeModel
            ->where('email', $email)
            ->first();

        if (! $employee) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Email not found.');
        }

        // Email Verification Check
        if ($employee['email_verified'] == 0) {

            return redirect()->back()
                ->with('error', 'Please verify your email before resetting your password.');
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Save OTP
        $this->otpModel->insert([
            'employee_id' => $employee['id'],
            'otp'         => $otp,
            'purpose'     => 'forgot_password',
            'expires_at'  => date('Y-m-d H:i:s', strtotime('+10 minutes')),
            'is_used'     => 0,
        ]);

        // Send Email
        $emailService = Services::email();

        $emailService->setFrom('purnendu.india123@gmail.com', 'CI4 User Login');

        $emailService->setTo($employee['email']);

        $emailService->setSubject('Password Reset OTP');

        $emailService->setMessage("
            <h2>Password Reset</h2>

            <p>Hello <strong>{$employee['first_name']}</strong>,</p>

            <p>Your Password Reset OTP is:</p>

            <h1 style='color:#0d6efd;letter-spacing:3px;'>{$otp}</h1>

            <p>This OTP is valid for <strong>10 minutes</strong>.</p>

            <br>

            <p>If you did not request a password reset, please ignore this email.</p>

            <p>Thank You</p>

            <p><strong>CI4 User Login System</strong></p>
        ");

        if (! $emailService->send()) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Unable to send OTP. Please try again.');
        }

        // Store Session
        session()->set([
            'reset_employee_id' => $employee['id'],
            'reset_email'       => $employee['email'],
        ]);

        // Redirect
        return redirect()->to('/reset-password')
            ->with('success', 'A 6-digit OTP has been sent to your registered email address.');
    }


    /*
|--------------------------------------------------------------------------
| Reset Password
|--------------------------------------------------------------------------
*/

    public function resetPassword()
    {
        if ($this->request->getMethod() == 'GET') {

            return view('auth/reset_password');
        }

        $rules = [

            'otp' => 'required|numeric|exact_length[6]',

            'password' => 'required|min_length[6]',

            'confirm_password' => 'required|matches[password]',
        ];


        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }


        $employeeId = session()->get('reset_employee_id');

        if (!$employeeId) {

            return redirect()->to('/forgot-password')
                ->with('error', 'Session expired.');
        }


        $otp = $this->request->getPost('otp');


        $otpData = $this->otpModel
            ->where('employee_id', $employeeId)
            ->where('purpose', 'forgot_password')
            ->where('is_used', 0)
            ->orderBy('id', 'DESC')
            ->first();


        if (!$otpData) {

            return redirect()->back()
                ->with('error', 'OTP not found.');
        }


        if (strtotime($otpData['expires_at']) < time()) {

            return redirect()->back()
                ->with('error', 'OTP has expired.');
        }


        if ($otp != $otpData['otp']) {

            return redirect()->back()
                ->with('error', 'Invalid OTP.');
        }


        // Update Password

        $this->employeeModel->update($employeeId, [

            'password' => $this->request->getPost('password'),

        ]);


        // OTP Used

        $this->otpModel->update($otpData['id'], [

            'is_used' => 1

        ]);


        session()->remove([

            'reset_employee_id',

            'reset_email'

        ]);


        return redirect()->to('/')
            ->with('success', 'Password reset successful. Please login.');
    }



    public function logout()
    {
        session()->destroy();

        return redirect()->to('/')
            ->with('success', 'You have been logged out successfully.');
    }
}
