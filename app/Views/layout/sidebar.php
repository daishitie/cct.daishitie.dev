<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= config('app.url'); ?>">
        <div class="sidebar-brand-text"><?= config('app.name'); ?></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item<?= $data['title'] == 'Dashboard' ? ' active' : ''; ?>">
        <a class="nav-link" href="<?= config('app.url'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <?php if ($data['user_session']) : ?>
        <?php if ($data['user_session']['role_id'] != 1) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAlerts" aria-expanded="true" aria-controls="collapseAlerts">
                    <i class="fas fa-fw fa-bell"></i>
                    <span>Alerts</span>
                </a>
                <div id="collapseAlerts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= config('app.url'); ?>/alerts">View Alerts</a>
                        <a class="collapse-item" href="<?= config('app.url'); ?>/alerts/create">Create Alert</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRecords" aria-expanded="true" aria-controls="collapseRecords">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Records</span>
                </a>
                <div id="collapseRecords" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= config('app.url'); ?>/records">View Records</a>
                        <a class="collapse-item" href="<?= config('app.url'); ?>/records/create">Create Record</a>
                    </div>
                </div>
            </li>

            <li class="nav-item<?= $data['title'] == 'Accounts' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?= config('app.url'); ?>/users">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Accounts</span>
                </a>
            </li>
        <?php else : ?>
            <li class="nav-item<?= $data['title'] == 'Alerts' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?= config('app.url'); ?>/alerts">
                    <i class="fas fa-fw fa-bell"></i>
                    <span>Alerts</span>
                </a>
            </li>

            <li class="nav-item<?= $data['title'] == 'Records' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?= config('app.url'); ?>/records">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Records</span>
                </a>
            </li>
        <?php endif; ?>
    <?php endif; ?>
</ul>