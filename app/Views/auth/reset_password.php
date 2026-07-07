<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .reset-box {
            width: 430px;
            margin: auto;
            margin-top: 70px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .12);
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="reset-box">

            <div class="card">

                <div class="card-body p-4">

                    <h3 class="text-center mb-2">
                        Reset Password
                    </h3>

                    <p class="text-center text-muted mb-4">
                        Enter the OTP sent to your email and create a new password.
                    </p>

                    <?php if (session()->getFlashdata('success')) : ?>

                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>

                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>

                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>

                    <?php endif; ?>

                    <form action="<?= site_url('reset-password') ?>" method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">

                            <label class="form-label">OTP</label>

                            <input
                                type="text"
                                name="otp"
                                class="form-control <?= session('errors.otp') ? 'is-invalid' : '' ?>"
                                value="<?= old('otp') ?>"
                                placeholder="Enter OTP">

                            <div class="invalid-feedback">
                                <?= session('errors.otp') ?>
                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">New Password</label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                                placeholder="New Password">

                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Confirm Password</label>

                            <input
                                type="password"
                                name="confirm_password"
                                id="confirm_password"
                                class="form-control <?= session('errors.confirm_password') ? 'is-invalid' : '' ?>"
                                placeholder="Confirm Password">

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
                            Reset Password
                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <a href="<?= site_url('/') ?>">
                            Back to Login
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $('#showPassword').change(function() {

            let type = $(this).is(':checked') ? 'text' : 'password';

            $('#password').attr('type', type);

            $('#confirm_password').attr('type', type);

        });
    </script>

</body>

</html>