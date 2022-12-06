<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dastyle - Admin & Dashboard Template</title>
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
                                                class="feather feather-tag align-self-center text-muted icon-md">
                                                <path
                                                    d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                                </path>
                                                <line x1="7" y1="7" x2="7.01" y2="7">
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
                                                class="feather feather-package align-self-center text-muted icon-md">
                                                <line x1="16.5" y1="9.4" x2="7.5" y2="4.21">
                                                </line>
                                                <path
                                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                </path>
                                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                <line x1="12" y1="22.08" x2="12" y2="12">
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
                                            <td><span
                                                    class="badge badge-md badge-soft-{{ $item->a1 != null ? 'primary' : 'light' }}">{{ $item->a1 }}</span>
                                            </td>
                                            <td><span
                                                    class="badge badge-md badge-soft-{{ $item->a2 > 0 ? 'primary' : 'light' }}">{{ $item->a2 }}</span>
                                            </td>
                                            <td><span
                                                    class="badge badge-md badge-soft-{{ $item->a3 > 0 ? 'primary' : 'light' }}">{{ $item->a3 }}</span>
                                            </td>
                                            <td><span
                                                    class="badge badge-md badge-soft-{{ $item->a4 > 0 ? 'primary' : 'light' }}">{{ $item->a4 }}</span>
                                            </td>
                                            <td><span
                                                    class="badge badge-md badge-soft-{{ $item->persen > 0 ? 'primary' : 'light' }}">{{ $item->persen }}</span>
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
