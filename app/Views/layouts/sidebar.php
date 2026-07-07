<div class="sidebar">

    <h4 class="text-white text-center py-3">
        EMS
    </h4>

    <a href="<?= site_url('dashboard') ?>">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <?php if (session()->get('role') == 'admin'): ?>
        <a href="<?= site_url('employees') ?>">
            <i class="bi bi-people"></i>
            Employee List
        </a>
    <?php endif ?>

    <?php if (session()->get('role') == "admin"): ?>
        <a href="<?= site_url('employees/create') ?>">
            <i class="bi bi-person-plus"></i>
            Add Employee
        </a>
    <?php endif ?>

    <a href="<?= site_url('profile') ?>">
        <i class="bi bi-person-circle"></i>
        Profile
    </a>


    <a href="<?= site_url('logout') ?>">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </a>

</div>