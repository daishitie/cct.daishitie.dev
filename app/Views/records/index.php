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
                                <table class="table table-hover table-bordered" id="recordsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>City</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['patients'] as $patient) : ?>
                                            <tr>
                                                <td><?= $patient->id ?></td>
                                                <td><?= $patient->status ?></td>
                                                <td><?= $patient->lastname ?>, <?= $patient->firstname ?></td>
                                                <td><?= $patient->age ?></td>
                                                <td><?= $patient->gender ?></td>
                                                <td><?= $patient->email ?></td>
                                                <td><?= $patient->mobile ?></td>
                                                <td><?= $patient->city ?></td>
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