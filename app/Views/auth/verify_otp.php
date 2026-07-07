<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .otp-box{
            width:420px;
            margin:auto;
            margin-top:80px;
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

    <div class="otp-box">

        <div class="card">

            <div class="card-body p-4">

                <h3 class="text-center mb-2">
                    Verify OTP
                </h3>

                <p class="text-center text-muted mb-4">
                    Enter the 6 digit OTP sent to your email.
                </p>

                <?php if(session()->getFlashdata('success')) : ?>

                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>

                <?php endif; ?>

                <?php if(session()->getFlashdata('error')) : ?>

                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>

                <?php endif; ?>

                <form action="<?= site_url('verify-otp') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="mb-3">

                        <label class="form-label">OTP</label>

                        <input
                            type="text"
                            name="otp"
                            maxlength="6"
                            value="<?= old('otp') ?>"
                            class="form-control <?= session('errors.otp') ? 'is-invalid' : '' ?>">

                        <div class="invalid-feedback">
                            <?= session('errors.otp') ?>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Verify OTP
                    </button>

                </form>

                <div class="text-center mt-3">

                    <a href="<?= site_url('register') ?>">
                        Back to Registration
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>
</html>