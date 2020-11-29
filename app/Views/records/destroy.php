<body id="page-top">
    <div id="wrapper">

        <?php require_once $sidebar; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php require_once $navbar; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800"><?= ucwords($data['title']); ?></h1>

                    <div class="row">
                        <?php if (!$data['hassuccess']) : ?>
                            <div class="col-xl-6 mb-4">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <form action="<?= config('app.url'); ?>/records/destroy/<?= $data['patient_id']; ?>" method="post">
                                            <input type="hidden" name="_token" value="<?= $data['csrf_token']; ?>">

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Patient ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= $data['patient_id']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Patient Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= $data['patient_name']; ?>">
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group row">
                                                <label for="password" class="col-sm-3 col-form-label">Your Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="password_session" id="password" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="form-group row m-0">
                                                <button type="submit" class="col-sm-12 form-control btn btn-danger btn-user btn-block">Confirm Record Deletion</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-xl-6 mb-4">
                            <?php if ($data['hassuccess']) : ?>
                                <div class="alert alert-success text-left">
                                    <p class="m-0"><?= $data['success']; ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if ($data['haserror']) : ?>
                                <div class="alert alert-danger text-left">
                                    <h4 class="alert-heading">Something went wrong!</h4>
                                    <p>
                                        <?php
                                        foreach ($data['errors'] as $value) {
                                            if (!empty($value)) {
                                                echo $value . '<br>';
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once $copyright; ?>
        </div>
    </div>
</body>