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
                                        <h1 class="h4 text-gray-900 mb-2">
                                            <strong><?= config('app.name'); ?></strong><br />
                                            Welcome Back!
                                        </h1>

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
                                    </div>
                                    <form class="user" action="<?= config('app.url'); ?>/login" method="post">
                                        <input type="hidden" name="_token" value="<?= $data['csrf_token']; ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Username / Email Address" value="<?php if ($data['username']) : echo $data['username'];
                                                                                                                                                                    endif; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= config('app.url'); ?>/register">Create an Account!</a>
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