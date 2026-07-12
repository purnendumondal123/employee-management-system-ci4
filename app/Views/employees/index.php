<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<div class="d-flex">

    <?= $this->include('layouts/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light" style="min-height:100vh;">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">Employee List</h2>
                <p class="text-muted mb-0">
                    Manage all employees from here.
                </p>
            </div>

            <a href="<?= site_url('employees/create') ?>" class="btn btn-primary">
                + Add Employee
            </a>

        </div>

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

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th width="60">SL No</th>
                                <th>Employee Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th width="200">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($employees)) : ?>

                                <?php
                                $perPage = 2; // paginate(2) 
                                $currentPage = $pager->getCurrentPage();
                                $i = 1 + ($perPage * ($currentPage - 1));
                                ?>

                                <?php foreach ($employees as $employee) : ?>

                                    <tr>

                                        <td><?= $i++ ?></td>

                                        <td><?= esc($employee['employee_code']) ?></td>

                                        <td>
                                            <?= esc($employee['first_name']) . ' ' . esc($employee['last_name']) ?>
                                        </td>

                                        <td><?= esc($employee['email']) ?></td>

                                        <td><?= esc($employee['mobile']) ?></td>

                                        <td>
                                            <?php if ($employee['status'] == 'active') : ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else : ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>

                                            <a href="<?= site_url('employees/edit/' . $employee['id']) ?>"
                                                class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <form action="<?= site_url('employees/delete/' . $employee['id']) ?>"
                                                method="post"
                                                class="d-inline">

                                                <?= csrf_field() ?>

                                                <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this employee?')">
                                                    Delete
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else : ?>

                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        No employee found.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>
                    <?= $pager->links('default', 'bootstrap') ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('layouts/footer') ?>