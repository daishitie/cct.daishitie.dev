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
                                    <form action="<?= config('app.url'); ?>/alerts/create" method="post">
                                        <input type="hidden" name="_token" value="<?= $data['csrf_token']; ?>">

                                        <div class="form-group row">
                                            <label for="type" class="col-sm-3 col-form-label">Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="type" id="type">
                                                    <option value="" disabled selected>Type</option>
                                                    <option value="1" <?php if ($data['type'] == 1) echo 'selected'; ?>>Primary</option>
                                                    <option value="2" <?php if ($data['type'] == 2) echo 'selected'; ?>>Success</option>
                                                    <option value="3" <?php if ($data['type'] == 3) echo 'selected'; ?>>Info</option>
                                                    <option value="4" <?php if ($data['type'] == 4) echo 'selected'; ?>>Warning</option>
                                                    <option value="5" <?php if ($data['type'] == 5) echo 'selected'; ?>>Danger</option>
                                                    <option value="6" <?php if ($data['type'] == 6) echo 'selected'; ?>>Light</option>
                                                    <option value="7" <?php if ($data['type'] == 7) echo 'selected'; ?>>Dark</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="message" class="col-sm-3 col-form-label">Message</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="message" id="message" placeholder="Message" value="<?= $data['message']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3"></label>
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="in_dashboard" value="1" id="inDashboard">
                                                    <label class="form-check-label" for="inDashboard">
                                                        In Dashboard
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row m-0">
                                            <button type="submit" class="col-sm-12 form-control btn btn-primary btn-user btn-block">Save Alert</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 mb-2">
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