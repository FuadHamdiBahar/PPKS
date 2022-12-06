{{-- @extends('layouts.form_main') --}}
@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-1 font-weight-semibold">Total Laporan</p>
                            <h3 class="my-0" id="total">-</h3>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-tag align-self-center text-muted icon-md">
                                    <path
                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                    </path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
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
                            <h3 class="my-0" id="capaian">-</h3>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-package align-self-center text-muted icon-md">
                                    <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                                    <path
                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                    </path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
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

        <!--end col-->
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Left sidebar -->
            <div class="email-leftbar">
                <div class="card">
                    <div class="card-body">
                        <p class="text-dark font-weight-bold">Filters</p>
                        <div class="mail-list">
                            <form action="3" id="myForm">


                                <div>
                                    <label for="status_select">Status</label>
                                    <select class="form-control" id="status_select" name="status_select" required>
                                        <option value="1,2,3,4" selected>Semua</option>
                                        <option value="1">Valid</option>
                                        <option value="3">Ditolak</option>
                                        <option value="4">Belum Valid</option>
                                    </select>
                                </div>

                                <div class="mt-1">
                                    <label for="year_select">Label</label>
                                    <select class="form-control" id="year_select" name="year_select" required>
                                        <option value="2022" selected>2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- End Left sidebar -->


            <!-- Right Sidebar -->
            <div class="email-rightbar">
                {{-- <div class="btn-toolbar" role="toolbar">


                    <select class="select2 form-control" id="univ_select" name="univ_select" required>
                        <option selected disabled>Pilih Nama Institusi</option>
                        @foreach ($nama_institusi as $nama)
                            <option value="{{ $nama->id_sp }}">{{ $nama->nm_lemb }}</option>
                        @endforeach
                    </select>

                </div> --}}



                <div class="card">
                    <!--end card-header-->
                    <div class="card-body">
                        <table id="contoh" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Kode Prodi</th>
                                    <th>Nama Prodi</th>
                                    <th>a1</th>
                                    <th>a2</th>
                                    <th>a3</th>
                                    <th>a4</th>
                                    <th>Persen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- end Col -->
        </div><!-- End row -->
    </div>
@endsection

@section('script')
    <script>
        var valid = $('#status_select').find(":selected").val();
        var tahun = new Date().getFullYear()

        createTable(valid, tahun)

        function createTable(valid, tahun) {
            $.ajax({
                url: '/api/admin/overview/a4/' + valid + '/' + tahun,
                type: 'GET',
                success: function(data) {
                    console.log(data)
                    $('#total').text(data['jumlah_laporan'])
                    $('#capaian').text(data['rata_capaian'] + '%')
                }
            })
            if ($.fn.dataTable.isDataTable('#contoh')) {
                table = $('#contoh').DataTable();
                table.destroy();
            }
            $('#contoh').DataTable({
                ajax: '/api/admin/overview/a4/' + valid + '/' + tahun,
                columns: [{
                        data: 'npsn'
                    },
                    {
                        data: 'nm_lemb'
                    },
                    {
                        data: 'a1'
                    },
                    {
                        data: 'a2'
                    },
                    {
                        data: 'a3'
                    },
                    {
                        data: 'a4'
                    },
                    {
                        data: 'persen'
                    },
                    {
                        data: 'id_sp',
                        sortable: false,
                        render: function(data) {
                            return `<a href="overview4A/` + data +
                                `" class=\"btn btn-sm btn-primary\">Detail</a>`
                        }
                    }
                ],
            });
        }
        $("#status_select").on('change', function() {
            valid = this.value
            createTable(valid, tahun)
        });
        $("#year_select").on('change', function() {
            tahun = parseInt(this.value)
            createTable(valid, tahun)
        });
    </script>
@endsection
