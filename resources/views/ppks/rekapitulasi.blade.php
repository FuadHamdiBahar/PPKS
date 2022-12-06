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
        {{-- <div class="col-md-6 col-lg-3">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-1 font-weight-semibold">On Hold</p>
                            <h3 class="my-0">15</h3>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-zap align-self-center text-muted icon-md">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div> --}}
        <!--end col-->
        {{-- <div class="col-md-6 col-lg-3">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-1 font-weight-semibold">Unassigned</p>
                            <h3 class="my-0">88</h3>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-lock align-self-center text-muted icon-md">
                                    <rect x="3" y="11" width="18" height="11" rx="2"
                                        ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div> --}}
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
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- End Left sidebar -->


            <!-- Right Sidebar -->
            <div class="email-rightbar">

                <div class=" my">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">{{ session()->get('namalengkap') }}</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <a id="print" href="">
                                        <i class="dripicons-print"></i> Cetak
                                    </a>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Instrumen</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end email-rightbar -->
            </div><!-- end Col -->
        </div><!-- End row -->
    </div>
@endsection

@section('script')
    <script>
        var id = "{{ $id }}"
        var valid = $('#status_select').find(":selected").val();
        var tahun = new Date().getFullYear()

        $("#print").attr('href', '/ppks/cetak/' + id + '/' + valid + '/' + tahun)

        createTable(id, valid, tahun)

        function createTable(id, valid, tahun) {
            console.log(id, valid, tahun)
            $.ajax({
                url: '/api/ppks/rekap/' + id + '/' + valid + '/' + tahun,
                type: 'GET',
                success: function(data) {
                    console.log(data)
                    $('#total').text(data['jumlah_laporan'])
                    $('#capaian').text(data['rata_capaian'] + '%')
                }
            })

            if ($.fn.dataTable.isDataTable('#myTable')) {
                table = $('#myTable').DataTable();
                table.destroy();
            }
            var t = $('#myTable').DataTable({
                ajax: '/api/ppks/rekap/' + id + '/' + valid + '/' + tahun,
                columns: [{
                        data: null
                    },
                    {
                        data: 'nama_inpp'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'id_inpp',
                        sortable: false,
                        render: function(data) {
                            return `<a href="` + data + `" class=\"btn btn-sm btn-primary\">Detail</a>`
                        }
                    }
                ],
                columnDefs: [{
                    render: function(data, type, full, meta) {
                        if (data == null) {
                            data = 0
                        }
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: [1]
                }]
            });
            t.on('order.dt search.dt', function() {
                t.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            console.log('selesai');
        }
        $("#status_select").on('change', function() {
            valid = this.value
            $("#print").attr('href', '/ppks/cetak/' + id + '/' + valid + '/' + tahun)
            createTable(id, valid, tahun)
        });
        $("#year_select").on('change', function() {
            tahun = parseInt(this.value)
            $("#print").attr('href', '/ppks/cetak/' + id + '/' + valid + '/' + tahun)
            createTable(id, valid, tahun)
        });
    </script>
@endsection
