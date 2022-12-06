<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>LLDITI IX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="">
    <div class="">
        <div class="">
            <div class="">
                <div class="row">
                    <div class="col-12 m-2">
                        <h4>{{ $nama_institusi }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col">
                                        <p class="text-dark mb-1 font-weight-semibold">Total Laporan</p>
                                        <h3 class="my-0" id="total">{{ $jumlah_laporan }}</h3>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="report-main-icon bg-light-alt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-server align-self-center text-muted icon-md">
                                                <rect x="2" y="2" width="20" height="8"
                                                    rx="2" ry="2"></rect>
                                                <rect x="2" y="14" width="20" height="8"
                                                    rx="2" ry="2"></rect>
                                                <line x1="6" y1="6" x2="6.01" y2="6">
                                                </line>
                                                <line x1="6" y1="18" x2="6.01" y2="18">
                                                </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-md-6 col-lg-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col">
                                        <p class="text-dark mb-1 font-weight-semibold">Total Persentase Capaian</p>
                                        <h3 class="my-0" id="persentase">{{ $rata_capaian }}%</h3>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="report-main-icon bg-light-alt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-percent align-self-center text-muted icon-md">
                                                <line x1="19" y1="5" x2="5" y2="19">
                                                </line>
                                                <circle cx="6.5" cy="6.5" r="2.5"></circle>
                                                <circle cx="17.5" cy="17.5" r="2.5"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="">

                            <table id="myTable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Program Studi</th>
                                        <th>Jenjang</th>
                                        <th>Anti Perundungan</th>
                                        <th>Anti Korupsi</th>
                                        <th>Anti Intoleransi</th>
                                        <th>Anti Kekerasan Seksual</th>
                                        <th>Persentase</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->prodi }}</td>
                                            <td>{{ $item->jenjang }}</td>
                                            <td><span class="">{{ $item->a1 == null ? 0 : $item->a1 }}</span>
                                            </td>
                                            <td><span class="">{{ $item->a2 == null ? 0 : $item->a1 }}</span>
                                            </td>
                                            <td><span class="">{{ $item->a3 == null ? 0 : $item->a1 }}</span>
                                            </td>
                                            <td><span class="">{{ $item->a4 == null ? 0 : $item->a1 }}</span>
                                            </td>
                                            <td><span class="">{{ $item->persen }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
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
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            window.print()
        })
    </script>
</body>

</html>
