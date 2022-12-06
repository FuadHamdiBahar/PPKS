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
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="account-body accountbg">

    <!-- Eror-404 page -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <a href="index.html" class="logo logo-admin">
                                        <img src="{{ URL::asset('images/lldikti.png') }}" height="50" alt="logo"
                                            class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">Oops! Halaman tidak
                                        ditemukan</h4>
                                    <p class="text-muted  mb-0">Kembali ke halaman awal.</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="ex-page-content text-center">
                                    <img src="{{ URL::asset('images/error.svg') }}" alt="0" class=""
                                        height="170">
                                    <h1 class="mt-5 mb-4">404!</h1>
                                    <h5 class="font-16 text-muted mb-5">Something went wrong</h5>
                                </div>
                                <a class="btn btn-primary btn-block waves-effect waves-light" href="/">Kembali
                                    ke Dashboard <i class="fas fa-redo ml-1"></i></a>
                            </div>
                            <div class="card-body bg-light-alt text-center">
                                <span class="text-muted d-none d-sm-inline-block">Mannatthemes © 2020</span>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
    <!-- End Eror-404 page -->




    <!-- jQuery  -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/feather.min.js"></script>
    <script src="js/simplebar.min.js"></script>


</body>

</html>
