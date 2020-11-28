<body ud="page-top">
    <div id="wrapper">

        <?php require_once $sidebar; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php require_once $navbar; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800"><?= ucwords($data['title']); ?></h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="accountsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['accounts'] as $account) : ?>
                                            <tr>
                                                <td><?= $account->id ?></td>
                                                <td><?= $account->role_title ?></td>
                                                <td><?= $account->lastname ?>, <?= $account->firstname ?></td>
                                                <td><?= $account->username ?></td>
                                                <td><?= $account->email ?></td>
                                                <td>
                                                    <a href="">Update</a>
                                                    <a href="">Delete</a>
                                                </td>
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