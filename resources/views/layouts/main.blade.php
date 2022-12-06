<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $tab_name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/tutwuri.ico') }}">

    <!-- DataTables -->
    <link href="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .text-wrap {
            white-space: normal;
        }

        .width-200 {
            width: 100%;
        }
    </style>

</head>

<body class="dark-sidenav">

    @include('partials.sidebar')


    <div class="page-wrapper">

        @include('partials.navbar')


        <div class="page-content">
            <div class="container-fluid">
                @include('partials.breadcrumb')

                @yield('container')


            </div>

            <footer class="footer text-center text-sm-left">
                &copy; 2020 Dastyle <span class="d-none d-sm-inline-block float-right">Crafted with <i
                        class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
            </footer>

        </div>


    </div>

    <!-- jQuery  -->
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('js/metismenu.min.js') }}"></script>
    <script src="{{ URL::asset('js/waves.js') }}"></script>
    <script src="{{ URL::asset('js/feather.min.js') }}"></script>
    <script src="{{ URL::asset('js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ URL::asset('plugins/apex-charts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/flot-chart/jquery.canvaswrapper.js') }}"></script>
    <script src="{{ URL::asset('plugins/flot-chart/jquery.colorhelpers.js') }}"></script>
    <script src="{{ URL::asset('plugins/flot-chart/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('plugins/flot-chart/jquery.flot.saturated.js') }}"></script>
    <script src="{{ URL::asset('plugins/flot-chart/jquery.flot.browser.js') }}"></script>
    <script src="{{ URL::asset('plugins/flot-chart/jquery.flot.drawSeries.js') }}"></script>
    <script src="{{ URL::asset('plugins/flot-chart/jquery.flot.uiConstants.js') }}"></script>
    <script src="{{ URL::asset('plugins/flot-chart/jquery.flot-dataType.js') }}"></script>

    <script src="{{ URL::asset('pages/jquery.crm_dashboard.init.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ URL::asset('pages/jquery.datatable.init.js') }}"></script>
    <script src="{{ URL::asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('pages/jquery.forms-advanced.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('js/app.js') }}"></script>

    @yield('script')



</body>

</html>
