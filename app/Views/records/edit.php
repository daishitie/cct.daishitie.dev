<body id="page-top">
    <div id="wrapper">

        <?php require_once $sidebar; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php require_once $navbar; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800"><?= ucwords($data['title']); ?></h1>

                    <div class="row">
                        <div class="col-xl-6 mb-2">
                            <div class="card shadow">
                                <div class="card-body">
                                    <form action="<?= config('app.url'); ?>/records/edit/<?= $data['patient_id']; ?>" method="post">
                                        <input type="hidden" name="_token" value="<?= $data['csrf_token']; ?>">

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Patient ID</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" value="<?= $data['patient_id']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="status" id="status">
                                                    <option value="" disabled selected>Status</option>
                                                    <option value="1" <?php if ($data['status'] == 1) echo 'selected'; ?>>Negative</option>
                                                    <option value="2" <?php if ($data['status'] == 2) echo 'selected'; ?>>Positive</option>
                                                    <option value="3" <?php if ($data['status'] == 3) echo 'selected'; ?>>Recovered</option>
                                                    <option value="4" <?php if ($data['status'] == 4) echo 'selected'; ?>>Deceased</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="firstname" class="col-sm-3 col-form-label">First name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name" value="<?= $data['firstname']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="middlename" class="col-sm-3 col-form-label">Middle name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Middle name" value="<?= $data['middlename']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="lastname" class="col-sm-3 col-form-label">Last name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" value="<?= $data['lastname']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email address" value="<?= $data['email']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?= $data['mobile']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="age" class="col-sm-3 col-form-label">Age</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" name="age" id="age" placeholder="Age" value="<?= $data['age']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="city" class="col-sm-3 col-form-label">City</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?= $data['city']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="gender" id="gender">
                                                    <option value="" disabled selected>Gender</option>
                                                    <option value="1" <?php if ($data['gender'] == 1) echo 'selected'; ?>>Male</option>
                                                    <option value="2" <?php if ($data['gender'] == 2) echo 'selected'; ?>>Female</option>
                                                    <option value="3" <?php if ($data['gender'] == 3) echo 'selected'; ?>>Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="password_session" class="col-sm-3 col-form-label">Your Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password_session" id="password_session" placeholder="Your Password">
                                            </div>
                                        </div>

                                        <div class="form-group row m-0">
                                            <button type="submit" class="col-sm-12 form-control btn btn-primary btn-user btn-block">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 mb-2">
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