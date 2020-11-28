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
                                    <form action="">
                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="status">
                                                    <option>Negative</option>
                                                    <option>Positive</option>
                                                    <option>Recovered</option>
                                                    <option>Deceased</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="firstname" class="col-sm-3 col-form-label">First name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="firstname" placeholder="First name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="middlename" class="col-sm-3 col-form-label">Middle name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="middlename" placeholder="Middle name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="lastname" class="col-sm-3 col-form-label">Last name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="lastname" placeholder="Last name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" placeholder="Email address">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="mobile" placeholder="Mobile">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="age" class="col-sm-3 col-form-label">Age</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="age" placeholder="Age">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="city" class="col-sm-3 col-form-label">City</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="city" placeholder="City">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="gender">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
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