# Employee Management System (CodeIgniter 4)

A complete Employee Management System built with **CodeIgniter 4**, **PHP 8.2**, and **MySQL**. The system provides secure authentication, email OTP verification, employee management, profile management, dashboard statistics, activity logs, and role-based access.

---

# Features

## Authentication
- Employee Registration
- Email OTP Verification
- Secure Login
- Logout
- Forgot Password
- Reset Password
- Password Hashing (`password_hash()` & `password_verify()`)
- Session-based Authentication

## Employee Management
- Add Employee
- Employee List
- Edit Employee
- Soft Delete Employee
- Pagination

## Dashboard
- Total Employees
- Active Employees
- Inactive Employees
- Verified Employees
- Recent Employees

## Profile Management
- View Profile
- Update Profile
- Upload Profile Photo
- Change Password

## Activity Logs
- Record User Activities
- View Activity History

## Security
- Server-side Validation
- CSRF Protection
- Input Sanitization
- Secure Password Storage
- Role-based Access Control

---

# Technologies Used

- PHP 8.2
- CodeIgniter 4
- MySQL
- Bootstrap 5
- jQuery
- HTML5
- CSS3
- JavaScript

---

# Installation

## 1. Clone the Repository

```bash
git clone https://github.com/purnendumondal123/employee-management-system-ci4.git
```

## 2. Move to the Project Directory

```bash
cd employee-management-system-ci4
```

## 3. Install Dependencies

```bash
composer install
```

## 4. Create Environment File

Copy:

```
.env.example
```

Rename it to:

```
.env
```

---

## 5. Configure Database

Update your database configuration inside the `.env` file.

```env
database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_database_username
database.default.password = your_database_password
database.default.DBDriver = MySQLi
database.default.port = 3306
```

---

## 6. Configure SMTP

Update the following values inside the `.env` file.

```env
email.fromEmail = your_email@gmail.com
email.fromName = CI4_User_Login

email.SMTPUser = your_email@gmail.com
email.SMTPPass = your_gmail_app_password
```

> **Note:** Use a Gmail **App Password**, not your Gmail account password.

---

## 7. Run Database Migrations

```bash
php spark migrate
```

---

## 8. Start the Development Server

```bash
php spark serve
```

Open your browser:

```
http://localhost:8080
```

---

# First Admin Setup

before login run this command - php spark db:seed AdminSeeder
create default admin email (**admin@example.com**) password is - (**Admin@123**)

After the first registration, every user is created with the default role **employee**.

To access the Admin Panel for the first time, update the user's role from **employee** to **admin** in the **employees** table.

Example SQL:

```sql
UPDATE employees
SET role = 'admin'
WHERE email = 'your_email@example.com';
```

You can also update the **role** field using **phpMyAdmin**.

After creating the first Admin account, all employee management features can be accessed from the Admin Dashboard.

---

# Project Structure

- Authentication Module
- Employee Management Module
- Dashboard Module
- Profile Module
- Activity Log Module
- Email OTP Verification Module

---

# Author

**Purnendu Mondal**

GitHub:
https://github.com/purnendumondal123
