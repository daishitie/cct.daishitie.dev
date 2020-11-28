<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-4 d-none d-lg-block bg-login-image" style="background-image: url(<?= config('app.url') . '/public/images/tokyo-japan.jpeg'; ?>);"></div>
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            <strong><?= config('app.name'); ?></strong><br />
                                            Create an Account!
                                        </h1>
                                    </div>

                                    <?php if ($data['haserror']) : ?>
                                        <div class="alert alert-danger text-left">
                                            <?php
                                            foreach ($data['errors'] as $value) {
                                                if (!empty($value)) {
                                                    echo '</i>&nbsp;' . $value . '<br>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="user" action="<?= config('app.url'); ?>/register" method="post">
                                        <input type="hidden" name="_token" value="<?= $data['csrf_token']; ?>">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name" value="<?= $data['firstname']; ?>">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name" value="<?= $data['lastname']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Username" value="<?= $data['username']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="email" placeholder="Email Address" value="<?= $data['email']; ?>">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" value="<?= $data['password']; ?>">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control form-control-user" name="repeatpassword" placeholder="Repeat Password" value="<?= $data['repeatpassword']; ?>">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= config('app.url'); ?>/login">Already have an account? Login!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= config('app.url'); ?>">Back to Dashboard</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>