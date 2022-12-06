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

    <!-- Plugins css -->
    <link href="{{ URL::asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('plugins/timepicker/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet" />

    {{-- css upload file input --}}
    <link href="{{ URL::asset('plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">

    <!-- App css -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="dark-sidenav">
    @include('partials.sidebar')


    <div class="page-wrapper">
        @include('partials.navbar')

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                @include('partials.breadcrumb')

                @yield('container')

            </div><!-- container -->

            <footer class="footer text-center text-sm-left">
                &copy; 2020 Dastyle <span class="d-none d-sm-inline-block float-right">Crafted with <i
                        class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
            </footer>
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->




    <!-- jQuery  -->
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('js/metismenu.min.js') }}"></script>
    <script src="{{ URL::asset('js/waves.js') }}"></script>
    <script src="{{ URL::asset('js/feather.min.js') }}"></script>
    <script src="{{ URL::asset('js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('js/moment.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>

    <script src="{{ URL::asset('pages/jquery.forms-advanced.js') }}"></script>

    {{-- Plugin untuk upload dokumen --}}
    <script src="{{ URL::asset('plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ URL::asset('pages/jquery.form-upload.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('js/app.js') }}"></script>

    @yield('script')
    {{-- kurikulum dropdown --}}
    <script>
        $("#id_sms").change(function() {
            var prodiID = $(this).val();
            console.log(prodiID);
            if (prodiID) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('getKurikulum') }}?id_sms=" + prodiID,
                    success: function(res) {
                        if (res) {
                            $("#id_kurikulum").empty();
                            $("#id_kurikulum").append(
                                "<option selected disabled>Pilih Kurikulum</option>");
                            $("#id_matkul").empty();
                            $("#id_matkul").append(
                                "<option selected disabled>Pilih Mata Kuliah</option>");
                            $.each(res, function(key, value) {
                                $("#id_kurikulum").append("<option value='" + key + "'>" +
                                    value + "</option>");
                            });
                        } else {
                            $("#id_kurikulum").empty();
                        }
                    }
                })
            } else {
                $("#id_kurikulum").empty();
            }
        });

        $("#id_kurikulum").change(function() {
            var matkulID = $(this).val();
            console.log(matkulID);
            if (matkulID) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('getMataKuliah') }}?id_kurikulum_sp=" + matkulID,
                    success: function(res) {
                        if (res) {
                            $("#id_matkul").empty();
                            $("#id_matkul").append(
                                "<option selected disabled>Pilih Mata Kuliah</option>");
                            $.each(res, function(key, value) {
                                $("#id_matkul").append("<option value='" + key + "'>" +
                                    value + "</option>");
                            });
                        } else {
                            $("#id_matkul").empty();
                        }
                    }
                })
            } else {
                $("#id_matkul").empty();
            }
        });
    </script>
    {{-- end kurikulum dropdown --}}
</body>

</html>
