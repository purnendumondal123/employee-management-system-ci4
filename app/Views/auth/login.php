<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .login-box {
            width: 420px;
            margin: auto;
            margin-top: 80px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .1);
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="login-box">

            <div class="card">

                <div class="card-body p-4">

                    <h3 class="text-center mb-4">

                        Employee Login

                    </h3>

                    <?php if (session()->getFlashdata('error')): ?>

                        <div class="alert alert-danger">

                            <?= session()->getFlashdata('error') ?>

                        </div>

                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>

                        <div class="alert alert-success">

                            <?= session()->getFlashdata('success') ?>

                        </div>

                    <?php endif; ?>

                    <form action="<?= site_url('/login') ?>" method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">

                            <label class="form-label"> Email </label>

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

                            <label class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>">

                            <div class="invalid-feedback">

                                <?= session('errors.password') ?>

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

                        <div class="d-flex justify-content-between mb-3">

                            <a href="<?= site_url('forgot-password') ?>">

                                Forgot Password?

                            </a>

                            <a href="<?= site_url('register') ?>">

                                Create Account

                            </a>

                        </div>

                        <button type="submit" class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $('#showPassword').change(function() {

            let type = $(this).is(':checked') ? 'text' : 'password';

            $('#password').attr('type', type);

        });
    </script>

</body>

</html>