@extends('layouts.main')

@section('container')
    {{-- <div class="row justify-content-center">
        <div class="col-md-6 col-lg-3">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-1 font-weight-semibold">Sessions</p>
                            <h3 class="my-2">24k</h3>
                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i
                                        class="mdi mdi-trending-up"></i>8.5%</span> New Sessions Today</p>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <i data-feather="users" class="align-self-center text-muted icon-md"></i>
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
                            <p class="text-dark mb-1 font-weight-semibold">Avg.Sessions</p>
                            <h3 class="my-2">00:18</h3>
                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i
                                        class="mdi mdi-trending-up"></i>1.5%</span> Weekly Avg.Sessions</p>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <i data-feather="clock" class="align-self-center text-muted icon-md"></i>
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
                            <p class="text-dark mb-1 font-weight-semibold">Bounce Rate</p>
                            <h3 class="my-2">$2400</h3>
                            <p class="mb-0 text-truncate text-muted"><span class="text-danger"><i
                                        class="mdi mdi-trending-down"></i>35%</span> Bounce Rate Weekly</p>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <i data-feather="activity" class="align-self-center text-muted icon-md"></i>
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
                            <p class="text-dark mb-1 font-weight-semibold">Goal Completions</p>
                            <h3 class="my-2">85000</h3>
                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i
                                        class="mdi mdi-trending-up"></i>10.5%</span> Completions Weekly</p>
                        </div>
                        <div class="col-auto align-self-center">
                            <div class="report-main-icon bg-light-alt">
                                <i data-feather="briefcase" class="align-self-center text-muted icon-md"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div> --}}
    <!--end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 offset-lg-1 align-self-center">
                            <div class="p-5">
                                <span class="bg-soft-pink p-2 rounded">Youtube Video</span>
                                <h1 class="my-4 font-weight-bold">Sosialisasi dan Panduan Penggunaan Aplikasi Penanganan dan
                                    Pencegahan 4 Dosa di PTS <span class="text-primary"> LLDIKTI9</span>.</h1>
                                <p class="font-14 text-muted">Selasa, 6 September 2022 <br> Pukul 09.00 WITA - Selesai</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-5 offset-lg-1 text-center">
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/Sc3Ke-jS11s"
                                frameborder="0" allowfullscreen></iframe>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Diagram Batang A4</h4>
                        </div>
                        <!--end col-->
                        <div class="col-auto">

                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="">
                        <div id="chart" class=""></div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Diagram Lingkaran A4</h4>
                        </div>
                        <!--end col-->
                        <div class="col-auto">
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="my-5">
                        <div id="chart2" class=""></div>
                    </div>

                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Rekapitulasi PPKS</h4>
                        </div>
                        <!--end col-->
                        <div class="col-auto">

                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="card-body">
                        <table id="" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perguruan Tinggi</th>
                                    <th>Instrumen Terlapor</th>
                                    <th>Persentase</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>


                            <tbody>
                                {{-- @foreach ($rekap_laporan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nm_lemb }}</td>
                                        <td>{{ $item->instrumen_terlapor }}</td>
                                        <td>{{ $item->capaian }}%</td>
                                        <td><span
                                                class="badge badge-md badge-soft-{{ $item->instrumen_terlapor > 0 ? 'danger' : 'light' }}">{{ $item->antiperundungan }}</span>
                                        </td>
                                        <td><span
                                                class="badge badge-md badge-soft-{{ $item->antikorupsi > 0 ? 'danger' : 'light' }}">{{ $item->antikorupsi }}</span>
                                        </td>
                                        <td><span
                                                class="badge badge-md badge-soft-{{ $item->antiintoleransi > 0 ? 'danger' : 'light' }}">{{ $item->antiintoleransi }}</span>
                                        </td>
                                        <td><span
                                                class="badge badge-md badge-soft-{{ $item->antikeseks > 0 ? 'danger' : 'light' }}">{{ $item->antikeseks }}</span>
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
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bagaimana cara membuat laporan 4A?</h4>
                    </p>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled faq-qa">
                                <li class="">
                                    <h6 class="">1. Tekan menu 4A maka akan muncul submenu</h6>
                                </li>
                                <li class="">
                                    <h6 class="">2. Tekan submenu Pelaporan </h6>
                                </li>
                                <li class="">
                                    <h6 class="">3. Tekan tombol Tambah Pelaporan yang terletak dibagian atas tabel
                                    </h6>
                                    <img src="{{ URL::asset('/images/a41.png') }}" alt="" class="img-fluid">
                                </li>
                                <li class="">
                                    <h6 class="">4. Isi semua form, kemudian tekan tombol buat laporan dibagian paling
                                        bawah form</h6>
                                </li>
                                <li class="">
                                    <h6 class="">5. Data berhasil ditambahkan</h6>
                                    <img src="{{ URL::asset('/images/a42.png') }}" alt="" class="img-fluid">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bagaimana cara membuat laporan PPKS?</h4>
                    </p>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled faq-qa">
                                <li class="">
                                    <h6 class="">1. Tekan menu PPKS maka akan muncul submenu</h6>
                                </li>
                                <li class="">
                                    <h6 class="">2. Tekan submenu Pelaporan </h6>
                                </li>
                                <li class="">
                                    <h6 class="">3. Tekan tombol Tambah Pelaporan yang terletak dibagian atas tabel
                                    </h6>
                                    <img src="{{ URL::asset('/images/ppks1.png') }}" alt="" class="img-fluid">
                                </li>
                                <li class="">
                                    <h6 class="">4. Isi semua form, kemudian tekan tombol buat laporan dibagian paling
                                        bawah form</h6>
                                </li>
                                <li class="">
                                    <h6 class="">5. Data berhasil ditambahkan</h6>
                                    <img src="{{ URL::asset('/images/ppks2.png') }}" alt="" class="img-fluid">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row--> --}}
@endsection
@section('script')
    <script>
        var data = {!! json_encode($rekap) !!}

        try {
            var y0 = data[0]['Jumlah']
            var y1 = data[1]['Jumlah']
            var y2 = data[2]['Jumlah']
            var y3 = data[3]['Jumlah']

            // console.log(y2 + 'ini');
        } catch (error) {
            if (y0 == undefined) {
                y0 = 0
            }

            if (y1 == undefined) {
                y1 = 0
            }

            if (y2 == undefined) {
                y2 = 0
            }

            if (y3 == undefined) {
                y3 = 0
            }

        }


        var options = {
            chart: {
                type: 'bar'
            },
            plotOptions: {
                bar: {
                    horizontal: true
                }
            },
            series: [{
                data: [{
                        x: 'Anti Perundungan',
                        y: y0
                    }, {
                        x: 'Anti Korupsi',
                        y: y1
                    }, {
                        x: 'Anti Intoleransi',
                        y: y2
                    }, {
                        x: 'Anti Kekerasan Seksual',
                        y: y3
                    }

                ]
            }]
        }
        var options2 = {
            chart: {
                type: 'pie'
            },
            series: [
                parseInt(y0),
                parseInt(y1),
                parseInt(y2),
                parseInt(y3)
            ],
            labels: ['Anti Perundungan', 'Anti Korupsi', 'Anti Intoleransi', 'Anti Kekerasan Seksual']
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);

        chart.render();
        chart2.render();
    </script>
@endsection
