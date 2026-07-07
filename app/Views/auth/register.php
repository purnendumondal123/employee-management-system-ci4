<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .register-box{
            width:550px;
            margin:auto;
            margin-top:40px;
        }

        .card{
            border:none;
            border-radius:10px;
            box-shadow:0 5px 20px rgba(0,0,0,.1);
        }

    </style>

</head>
<body>

<div class="container">

    <div class="register-box">

        <div class="card">

            <div class="card-body p-4">

                <h3 class="text-center mb-4">
                    Employee Registration
                </h3>

                <form action="<?= site_url('register') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">First Name</label>

                            <input
                                type="text"
                                name="firstname"
                                class="form-control <?= session('errors.firstname') ? 'is-invalid' : '' ?>"
                                value="<?= old('firstname') ?>">

                            <div class="invalid-feedback">
                                <?= session('errors.firstname') ?>
                            </div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Last Name</label>

                            <input
                                type="text"
                                name="lastname"
                                class="form-control <?= session('errors.lastname') ? 'is-invalid' : '' ?>"
                                value="<?= old('lastname') ?>">

                            <div class="invalid-feedback">
                                <?= session('errors.lastname') ?>
                            </div>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Employee Code</label>

                        <input
                            type="text"
                            name="employee_code"
                            class="form-control <?= session('errors.employee_code') ? 'is-invalid' : '' ?>"
                            value="<?= old('employee_code') ?>">

                        <div class="invalid-feedback">
                            <?= session('errors.employee_code') ?>
                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                            value="<?= old('email') ?>">

                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Mobile Number</label>

                        <input
                            type="text"
                            name="mobile"
                            class="form-control <?= session('errors.mobile') ? 'is-invalid' : '' ?>"
                            value="<?= old('mobile') ?>">

                        <div class="invalid-feedback">
                            <?= session('errors.mobile') ?>
                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Password</label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>">

                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Confirm Password</label>

                        <input
                            type="password"
                            id="confirm_password"
                            name="confirm_password"
                            class="form-control <?= session('errors.confirm_password') ? 'is-invalid' : '' ?>">

                        <div class="invalid-feedback">
                            <?= session('errors.confirm_password') ?>
                        </div>

                    </div>

                    <div class="form-check mb-3">

                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="showPassword">

                        <label class="form-check-label" for="showPassword">
                            Show Password
                        </label>

                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Register
                    </button>

                </form>

                <div class="text-center mt-3">

                    <a href="<?= site_url('/') ?>">
                        Already have an account? Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$('#showPassword').change(function(){

    let type = $(this).is(':checked') ? 'text' : 'password';

    $('#password').attr('type', type);

    $('#confirm_password').attr('type', type);

});

</script>

</body>
</html>