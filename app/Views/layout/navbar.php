<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <?php if (!empty($data['user_session'])) : ?>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="<?= config('app.url'); ?>" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-lg-inline text-gray-600 small">
                        Welcome back, <?= $data['user_session']['username'] ?>!
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <?php
                    /**<a class="dropdown-item" href="<?= config('app.url'); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="<?= config('app.url'); ?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="<?= config('app.url'); ?>">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>*/
                    ?>
                    <a class="dropdown-item" href="<?= config('app.url'); ?>" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a href="<?= config('app.url'); ?>/login" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
                <a href="<?= config('app.url'); ?>/register" class="nav-link">Register</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>