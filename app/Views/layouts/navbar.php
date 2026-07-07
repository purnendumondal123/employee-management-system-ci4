<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            Employee Management
        </a>

        <ul class="navbar-nav ms-auto">

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle"

                    data-bs-toggle="dropdown"

                    href="#">

                    Admin

                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <a class="dropdown-item"

                            href="<?= site_url('profile') ?>">

                            Profile

                        </a>

                    </li>

                    <li>

                        <a class="dropdown-item"

                            href="<?= site_url('forgot-password') ?>">

                            Change Password

                        </a>

                    </li>

                    <hr>

                    <li>

                        <a class="dropdown-item"

                            href="<?= site_url('logout') ?>">

                            Logout

                        </a>

                    </li>

                </ul>

            </li>

        </ul>

    </div>

</nav>