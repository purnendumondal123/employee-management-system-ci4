<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<?php $errors = session()->get('errors') ?? []; ?>

<div class="d-flex">

    <?= $this->include('layouts/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light" style="min-height:100vh;">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">Add Employee</h2>
                <p class="text-muted mb-0">
                    Create a new employee account.
                </p>
            </div>

            <a href="<?= site_url('employees') ?>" class="btn btn-secondary">
                Back
            </a>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <form action="<?= site_url('employees/store') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Employee Code</label>

                            <input
                                type="text"
                                name="employee_code"
                                class="form-control <?= isset($errors['employee_code']) ? 'is-invalid' : '' ?>"
                                value="<?= old('employee_code') ?>"
                                placeholder="Enter Employee Code">

                            <div class="invalid-feedback">
                                <?= $errors['employee_code'] ?? '' ?>
                            </div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Role</label>

                            <select
                                name="role"
                                class="form-select <?= isset($errors['role']) ? 'is-invalid' : '' ?>">

                                <option value="">Select Role</option>

                                <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>
                                    Admin
                                </option>

                                <option value="employee" <?= old('role') == 'employee' ? 'selected' : '' ?>>
                                    Employee
                                </option>

                            </select>

                            <div class="invalid-feedback">
                                <?= $errors['role'] ?? '' ?>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">First Name</label>

                            <input
                                type="text"
                                name="first_name"
                                class="form-control <?= isset($errors['first_name']) ? 'is-invalid' : '' ?>"
                                value="<?= old('first_name') ?>"
                                placeholder="Enter First Name">

                            <div class="invalid-feedback">
                                <?= $errors['first_name'] ?? '' ?>
                            </div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Last Name</label>

                            <input
                                type="text"
                                name="last_name"
                                class="form-control <?= isset($errors['last_name']) ? 'is-invalid' : '' ?>"
                                value="<?= old('last_name') ?>"
                                placeholder="Enter Last Name">

                            <div class="invalid-feedback">
                                <?= $errors['last_name'] ?? '' ?>
                            </div>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Email Address</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                            value="<?= old('email') ?>"
                            placeholder="Enter Email">

                        <div class="invalid-feedback">
                            <?= $errors['email'] ?? '' ?>
                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Mobile Number</label>

                        <input
                            type="text"
                            name="mobile"
                            class="form-control <?= isset($errors['mobile']) ? 'is-invalid' : '' ?>"
                            value="<?= old('mobile') ?>"
                            placeholder="Enter Mobile Number">

                        <div class="invalid-feedback">
                            <?= $errors['mobile'] ?? '' ?>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Password</label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                placeholder="Enter Password">

                            <div class="invalid-feedback">
                                <?= $errors['password'] ?? '' ?>
                            </div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Confirm Password</label>

                            <input
                                type="password"
                                name="confirm_password"
                                id="confirm_password"
                                class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>"
                                placeholder="Confirm Password">

                            <div class="invalid-feedback">
                                <?= $errors['confirm_password'] ?? '' ?>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Status</label>

                            <select
                                name="status"
                                class="form-select <?= isset($errors['status']) ? 'is-invalid' : '' ?>">

                                <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>
                                    Active
                                </option>

                                <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>
                                    Inactive
                                </option>

                            </select>

                            <div class="invalid-feedback">
                                <?= $errors['status'] ?? '' ?>
                            </div>

                        </div>

                        <div class="col-md-6 d-flex align-items-end mb-3">

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="showPassword">

                                <label class="form-check-label" for="showPassword">
                                    Show Password
                                </label>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        Save Employee
                    </button>

                    <a href="<?= site_url('employees') ?>" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('layouts/footer') ?>

<script>
    document.getElementById('showPassword').addEventListener('change', function() {

        let type = this.checked ? 'text' : 'password';

        document.getElementById('password').type = type;
        document.getElementById('confirm_password').type = type;

    });
</script>