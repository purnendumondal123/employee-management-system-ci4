# Employee Management System (CodeIgniter 4)

A complete **Employee Management System** built with **CodeIgniter 4** and **MySQL**. This project includes secure authentication, employee management, profile management, activity logging, and email OTP verification.

---

## Features

### Authentication

* Employee Registration
* Secure Login & Logout
* Email OTP Verification
* Forgot Password
* Reset Password
* Password Hashing using `password_hash()` and `password_verify()`
* Session-based Authentication

### Employee Management

* Add Employee
* View Employee List
* Update Employee Details
* Soft Delete Employee
* Pagination
* Search Employees

### Profile

* Update Profile Information
* Upload Profile Photo
* Change Password

### Dashboard

* Dashboard Overview
* Employee Statistics

### Activity Logs

* Record User Activities
* View Activity History

### Security

* Form Validation
* CSRF Protection
* Secure Password Storage
* Input Sanitization

---

## Technologies Used

* PHP 8.2
* CodeIgniter 4
* MySQL
* Bootstrap 5
* HTML5
* CSS3
* JavaScript

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/purnendumondal123/employee-management-system-ci4.git
```

### 2. Move to the project directory

```bash
cd employee-management-system-ci4
```

### 3. Install dependencies

```bash
composer install
```

### 4. Create the environment file

Copy `.env.example` to `.env`

Configure:

* Database Name
* Database Username
* Database Password
* SMTP Settings

### 5. Run migrations

```bash
php spark migrate
```

### 6. Start the development server

```bash
php spark serve
```

Open:

```
http://localhost:8080
```

---

## Project Structure

* Authentication Module
* Employee Management Module
* Profile Management Module
* Activity Log Module
* Dashboard Module
* Email OTP Verification

---

## Author

**Purnendu Mondal**

GitHub:
https://github.com/purnendumondal123
