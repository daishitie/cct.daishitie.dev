<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php if (Covid\App\Libraries\Session::exists('user-id')) : ?>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= config('app.url'); ?>/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<script src="<?= config('app.url'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= config('app.url'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= config('app.url'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= config('app.url'); ?>/js/sb-admin-2.min.js"></script>
<script src="<?= config('app.url'); ?>/vendor/chart.js/Chart.min.js"></script>
<script src="<?= config('app.url'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= config('app.url'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<?php if (strtolower($data['title']) == 'dashboard') : ?>

    <script>
        $(document).ready(function() {
            $('#caseByCityTable').DataTable({
                "ordering": false,
                "info": false
            });
        });

        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        new Chart(document.getElementById("genderChart"), {
            type: 'doughnut',

            data: {
                labels: ['Male', 'Female'],

                datasets: [{
                    data: ['1', '2'],
                    backgroundColor: ['#575fcf', '#ef5777'],
                    hoverBackgroundColor: ['#3c40c6', '#f53b57'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],

            },

            options: {
                maintainAspectRatio: false,

                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                },

                legend: {
                    display: true
                },

                cutoutPercentage: 50,
            },

        });
    </script>

<?php elseif (strtolower($data['title']) == 'records') : ?>

    <script>
        $(document).ready(function() {
            $('#recordsTable').DataTable({
                "ordering": false,
                "info": false
            });
        });
    </script>

<?php elseif (strtolower($data['title']) == 'accounts') : ?>

    <script>
        $(document).ready(function() {
            $('#accountsTable').DataTable({
                "ordering": false,
                "info": false
            });
        });
    </script>

<?php endif; ?>

</html>