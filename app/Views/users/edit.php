<body ud="page-top">
    <div id="wrapper">

        <?php require_once $sidebar; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php require_once $navbar; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800"><?= ucwords($data['title']); ?></h1>

                    <div class="row">
                        <div class="col-xl-6 mb-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <form action="<?= config('app.url'); ?>/users/edit" method="post">
                                        <input type="hidden" name="_token" value="<?= $data['csrf_token']; ?>">

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Account ID</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" value="<?= $data['user_id']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="role" class="col-sm-3 col-form-label">Role *</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="role" id="role">
                                                    <option value="1" <?php if ($data['role_id'] == 1) {
                                                                            echo ' selected';
                                                                        } ?>>Regular User</option>
                                                    <option value="2" <?php if ($data['role_id'] == 2) {
                                                                            echo ' selected';
                                                                        } ?>>Administrator</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="firstname" class="col-sm-3 col-form-label">First name *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name" value="<?= $data['firstname']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="lastname" class="col-sm-3 col-form-label">Last name *</label>
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
                                            <label for="username" class="col-sm-3 col-form-label">Username *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= $data['username']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                <small id="passwordHelpInline" class="text-muted">
                                                    Leave empty to not change the password.
                                                </small>
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
                                            <button type="submit" class="col-sm-12 form-control btn btn-primary btn-user btn-block">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 mb-4">
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