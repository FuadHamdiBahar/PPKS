<!-- Page-Title -->
<div class="row">
    <div class="col-sm-8">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">{{ $sub_menu }}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $main_menu }}</a></li>
                        <li class="breadcrumb-item active">{{ $sub_menu }}</li>
                    </ol>
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end page-title-box-->
    </div>
    <div class="col-sm-4">
        @if (session()->has('success'))
            <div class="alert alert-success mt-2" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <!--end col-->
</div>
<!--end row-->
<!-- end page title end breadcrumb -->
