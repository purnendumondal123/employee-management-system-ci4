<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="d-flex">

    <?= $this->include('layouts/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <h3>My Profile</h3>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- PROFILE IMAGE SHOW -->
        <div class="card p-4 mb-3 text-center">

            <?php if (!empty($user['profile_photo'])): ?>

                <img src="<?= base_url('uploads/profile/' . $user['profile_photo']) ?>"
                     width="120"
                     height="120"
                     class="rounded-circle border">

            <?php else: ?>

                <img src="<?= base_url('uploads/profile/default.png') ?>"
                     width="120"
                     height="120"
                     class="rounded-circle border">

            <?php endif; ?>

            <h5 class="mt-2">
                <?= $user['first_name'] . ' ' . $user['last_name'] ?>
            </h5>

        </div>

        <!-- UPDATE FORM -->
        <div class="card p-4">

            <form action="<?= site_url('profile/update') ?>" method="post">

                <input type="text" name="first_name"
                       value="<?= $user['first_name'] ?>"
                       class="form-control mb-2">

                <input type="text" name="last_name"
                       value="<?= $user['last_name'] ?>"
                       class="form-control mb-2">

                <input type="text" name="mobile"
                       value="<?= $user['mobile'] ?>"
                       class="form-control mb-2">

                <button class="btn btn-primary">Update</button>

            </form>

        </div>

        <br>

        <!-- UPLOAD PHOTO -->
        <div class="card p-4">

            <h5>Upload Profile Photo</h5>

            <form action="<?= site_url('profile/upload-photo') ?>"
                  method="post"
                  enctype="multipart/form-data">

                <input type="file" name="profile_photo"
                       class="form-control mb-2">

                <button class="btn btn-success">Upload</button>

            </form>

        </div>

    </div>
</div>

<?= $this->include('layouts/footer') ?>