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
                                            <?php if (isset($data['user_session']['role_id']) && intval($data['user_session']['role_id']) !== 1) : ?>
                                                <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['patients'] as $patient) : ?>
                                            <tr>
                                                <td><?= $patient->id ?></td>
                                                <td><?= $patient->status ?></td>
                                                <td>
                                                    <?php

                                                    if (isset($data['user_session']['role_id']) && intval($data['user_session']['role_id']) !== 1) {
                                                        echo "{$patient->lastname}, {$patient->firstname}";
                                                    } else {
                                                        $str = $patient->lastname . $patient->firstname;
                                                        $strLength = strlen($str);
                                                        echo substr($str, 0, 1) . str_repeat('*', $strLength - 2) . substr($str, $strLength - 1, 1);
                                                    }

                                                    ?>
                                                </td>
                                                <td><?= $patient->age ?></td>
                                                <td><?= $patient->gender ?></td>
                                                <td>
                                                    <?php

                                                    if (isset($data['user_session']['role_id']) && intval($data['user_session']['role_id']) !== 1) {
                                                        echo $patient->email;
                                                    } else {
                                                        if ($patient->email) {
                                                            $str = $patient->email;
                                                            $strLength = strlen($str);
                                                            echo substr($str, 0, 1) . str_repeat('*', $strLength - 2) . substr($str, $strLength - 1, 1);
                                                        }
                                                    }

                                                    ?>
                                                </td>
                                                <td>
                                                    <?php

                                                    if (isset($data['user_session']['role_id']) && intval($data['user_session']['role_id']) !== 1) {
                                                        echo $patient->mobile;
                                                    } else {
                                                        if ($patient->mobile) {
                                                            $str = $patient->mobile;
                                                            $strLength = strlen($str);
                                                            echo substr($str, 0, 0) . str_repeat('*', $strLength - 2) . substr($str, $strLength - 4, 4);
                                                        }
                                                    }

                                                    ?>
                                                </td>
                                                </td>
                                                <td><?= $patient->city ?></td>
                                                <?php if (isset($data['user_session']['role_id']) && intval($data['user_session']['role_id']) !== 1) : ?>
                                                    <td>
                                                        <a href="">Update</a>
                                                        <a href="">Delete</a>
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