<body ud="page-top">
    <div id="wrapper">

        <?php require_once $sidebar; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php require_once $navbar; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800"><?= ucwords($data['title']); ?></h1>

                    <div class="card shadow mb-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-bordered" id="alertsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Message</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <?php if ($data['user_session']['role_id'] != 1) : ?>
                                                <th>In Dashboard</th>
                                                <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['alerts'] as $alert) : ?>
                                            <tr>
                                                <td><?= $alert->id; ?></td>
                                                <td><?= ucwords($alert->type); ?></td>
                                                <td><?= $alert->message; ?></td>
                                                <td><?= $alert->created_at; ?></td>
                                                <td><?= $alert->updated_at; ?></td>
                                                <?php if ($data['user_session']['role_id'] != 1) : ?>
                                                    <td><?= $alert->in_dashboard ? 'Yes' : 'No'; ?></td>
                                                    <td class="m-auto">
                                                        <a href="<?= config('app.url'); ?>/alerts/edit/<?= $alert->id; ?>" class="btn btn-primary btn-icon-split btn-sm">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </span>
                                                            <span class="text">Edit</span>
                                                        </a>
                                                        <a href="<?= config('app.url'); ?>/alerts/destroy/<?= $alert->id; ?>" class="btn btn-danger btn-icon-split btn-sm">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </span>
                                                            <span class="text">Delete</span>
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once $copyright; ?>
        </div>
    </div>
</body>