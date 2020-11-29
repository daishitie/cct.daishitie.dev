<body id="page-top">
    <div id="wrapper">

        <?php require_once $sidebar; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php require_once $navbar; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800"><?= ucwords($data['title']); ?></h1>

                    <div class="row">
                        <?php foreach ($data['alerts'] as $alert) : ?>
                            <?php if ($alert) : ?>

                                <div class="col-xl-12">
                                    <div class="card bg-<?= $alert->type; ?> text-<?= $alert->text; ?> shadow mb-2">
                                        <div class="card-body">
                                            <?= $alert->message; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>
                        <?php endforeach; ?>

                        <div class="col-xl-12 col-md-6 mb-2">
                            <div class="card border-bottom-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Confirmed</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['patients_confirmed']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-check fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-2">
                            <div class="card border-bottom-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Negative</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['patients_negative']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-minus fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-4 mb-2">
                            <div class="card border-bottom-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Cases</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['patients_active']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-lock fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-4 mb-2">
                            <div class="card border-bottom-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Recovered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['patients_recovered']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-clock fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-4 mb-2">
                            <div class="card border-bottom-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Deceased</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['patients_deceased']; ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-skull fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-3">
                            <div class="card shadow mb-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Case by Gender</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie"><canvas id="genderChart"></canvas></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-9 col-md-9">
                            <div class="card shadow mb-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Case by City</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="caseByCityTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>City</th>
                                                    <th>Negative</th>
                                                    <th>Active Cases</th>
                                                    <th>Recovered</th>
                                                    <th>Deceased</th>
                                                </tr>
                                            </thead>
                                            <tbody><?= $data['patients_city']; ?></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once $copyright; ?>
        </div>
    </div>
</body>