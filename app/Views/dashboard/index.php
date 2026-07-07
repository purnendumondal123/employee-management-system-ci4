<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<div class="d-flex">

    <?= $this->include('layouts/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light" style="min-height:100vh;">

        <!-- Welcome -->

        <div class="mb-4">
            <h2 class="fw-bold">Welcome, <?= session()->get('role') == 'admin' ? 'Admin' : esc(session()->get('firstname')) ?></h2>
            <p class="text-muted">
                Welcome to the Employees <?= session()->get('role') == 'admin' ? "Management" : "" ?> Dashboard.
            </p>
        </div>

        <!-- Dashboard Cards -->

        <div class="row g-4 mb-4">

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Employees</h6>
                        <h2 class="fw-bold">
                            <?= $totalEmployees ?>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Active Employees</h6>
                        <h2 class="fw-bold text-success">
                            <?= $activeEmployees ?>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Inactive Employees</h6>
                        <h2 class="fw-bold text-danger">
                            <?= $inactiveEmployees ?>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Verified Employees</h6>
                        <h2 class="fw-bold text-primary">
                            <?= $verifiedEmployees ?>
                        </h2>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Employees -->

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Employees</h5>
            </div>

            <div class="card-body p-0">

                <table class="table table-hover mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>Employee Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($recentEmployees)) : ?>

                            <?php foreach ($recentEmployees as $employee) : ?>

                                <tr>

                                    <td><?= esc($employee['employee_code']) ?></td>

                                    <td>
                                        <?= esc($employee['first_name']) ?>
                                        <?= esc($employee['last_name']) ?>
                                    </td>

                                    <td><?= esc($employee['email']) ?></td>

                                    <td>

                                        <?php if ($employee['status'] == 'active') : ?>

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="4" class="text-center text-muted py-4">
                                    No employee found.
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Quick Actions -->

        <?php if (session()->get('role') == 'admin'): ?>
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>



                <div class="card-body">
                    <a href="<?= site_url('employees/create') ?>" class="btn btn-primary me-2">
                        Add Employee
                    </a>

                    <a href="<?= site_url('employees') ?>" class="btn btn-success me-2">
                        Employee List
                    </a>

                    <a href="<?= site_url('profile') ?>" class="btn btn-secondary">
                        My Profile
                    </a>

                </div>
        <?php endif ?>

            </div>

    </div>

</div>

<?= $this->include('layouts/footer') ?>