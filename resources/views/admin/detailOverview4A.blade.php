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
                                    class="feather feather-server align-self-center text-muted icon-md">
                                    <rect x="2" y="2" width="20" height="8" rx="2"
                                        ry="2"></rect>
                                    <rect x="2" y="14" width="20" height="8" rx="2"
                                        ry="2"></rect>
                                    <line x1="6" y1="6" x2="6.01" y2="6"></line>
                                    <line x1="6" y1="18" x2="6.01" y2="18"></line>
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
                            <h3 class="my-0" id="persentase">-</h3>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-percent align-self-center text-muted icon-md">
                                    <line x1="19" y1="5" x2="5" y2="19"></line>
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
            <div class="email-rightbar">
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
                                {{-- @foreach ($semua_laporan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->prodi }}</td>
                                        <td>{{ $item->jenjang }}</td>
                                        <td><span
                                                class="badge badge-md badge-soft-{{ $item->a1 > 0 ? 'danger' : 'light' }}">{{ $item->a1 }}</span>
                                        </td>
                                        <td><span
                                                class="badge badge-md badge-soft-{{ $item->a2 > 0 ? 'danger' : 'light' }}">{{ $item->a2 }}</span>
                                        </td>
                                        <td><span
                                                class="badge badge-md badge-soft-{{ $item->a3 > 0 ? 'danger' : 'light' }}">{{ $item->a3 }}</span>
                                        </td>
                                        <td><span
                                                class="badge badge-md badge-soft-{{ $item->a4 > 0 ? 'danger' : 'light' }}">{{ $item->a4 }}</span>
                                        </td>
                                        <td>
                                            <a href="/4a/{{ $item->id_sms }}"
                                                class="btn btn-primary waves-effect waves-light btn-sm"><i
                                                    class="mdi mdi-send mr-2"></i> Detail</a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    <!--end card-body-->
                </div>
            </div>
        </div>
    </div>

    <!--end card-->
@endsection


@section('script')
    <script>
        var id = "{{ $id }}"
        var valid = $('#status_select').find(":selected").val();
        var tahun = new Date().getFullYear()

        $("#print").attr('href', '/4a/cetak/' + id + '/' + valid + '/' + tahun)

        createTable(id, valid, tahun)

        function createTable(id, valid, tahun) {
            $.ajax({
                url: '/api/a4/rekap/' + id + '/' + valid + '/' + tahun,
                type: 'GET',
                success: function(data) {
                    console.log(data)
                    $("#total").text(data['jumlah_laporan'])
                    $("#persentase").text(data['rata_capaian'] + "%")
                }
            })

            if ($.fn.dataTable.isDataTable('#myTable')) {
                table = $('#myTable').DataTable();
                table.destroy();
            }
            var t = $('#myTable').DataTable({
                ajax: '/api/a4/rekap/' + id + '/' + valid + '/' + tahun,
                columns: [{
                        data: null
                    },
                    {
                        data: 'prodi'
                    },
                    {
                        data: 'jenjang'
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
                ],
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
            createTable(id, valid, tahun)
            $("#print").attr('href', '/4a/cetak/' + id + '/' + valid + '/' + tahun)
        });
        $("#year_select").on('change', function() {
            tahun = parseInt(this.value)
            createTable(id, valid, tahun)
            $("#print").attr('href', '/4a/cetak/' + id + '/' + valid + '/' + tahun)
        });
    </script>
@endsection
