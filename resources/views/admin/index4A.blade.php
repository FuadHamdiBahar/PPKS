@extends('layouts.main')


@section('container')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <ul class="nav nav-pills-custom nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-ajuan-tab" data-toggle="pill" href="#Ajuan" role="tab"
                                aria-controls="pills-ajuan" aria-selected="true">Ajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setuju-tab" data-toggle="pill" href="#Setuju" role="tab"
                                aria-controls="pills-setuju" aria-selected="false">Disetujui</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-tolak-tab" data-toggle="pill" href="#Tolak" role="tab"
                                aria-controls="pills-tolak" aria-selected="false">Ditolak</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    {{-- <a href="/4a/create" type="button" class="btn btn-sm btn-outline-light px-3">+ Tambah Pelaporan</a> --}}
                </div>
                <!--end col-->

                <!--end col-->
            </div>
            <!--end row-->
        </div>

        <!--end card-header-->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="Ajuan" role="tabpanel" aria-labelledby="pills-ajuan-tab">
                    <div class="table-responsive browser_users">
                        <table id='datatable' class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">No</th>
                                    <th class="border-top-0">Tanggal Pelaporan</th>
                                    <th class="border-top-0">Nama Perguruan Tinggi</th>
                                    <th class="border-top-0">Nama Kegiatan</th>
                                    <th class="border-top-0">Kegiatan/Matkul</th>
                                    <th class="border-top-0">Penanggung Jawab</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($ajuan_laporan as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->updated_on }}</td>
                                        <td>{{ $item->nm_lemb }}</td>
                                        <td>
                                            @if ($item->id_matkul)
                                                {{ $item->id_matkul }}
                                            @else
                                                {{ $item->kegiatan_a4 }}
                                            @endif
                                        </td>
                                        @if ($item->id_matkul)
                                            <td>{{ 'Matkul' }}</td>
                                        @else
                                            <td>{{ 'Kegiatan' }}</td>
                                        @endif
                                        <td>{{ $item->nama_pj }}</td>

                                        <td>
                                            <a href="/admin/4a/{{ $item->id_a4 }}" class="text-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <!--end /div-->
                </div>
                <div class="tab-pane fade" id="Setuju" role="tabpanel" aria-labelledby="pills-setuju-tab">
                    <div class="table-responsive browser_users">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">No</th>
                                    <th class="border-top-0">Tanggal Berlaku</th>
                                    <th class="border-top-0">Tanggal kadaluarsa</th>
                                    <th class="border-top-0">Nama Kegiatan</th>
                                    <th class="border-top-0">Kegiatan/Matkul</th>
                                    <th class="border-top-0">Penanggung Jawab</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($laporan_disetujui as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->tgl_berlaku }}</td>
                                        <td>{{ $item->tgl_kadaluarsa }}</td>
                                        <td>
                                            @if ($item->id_matkul)
                                                {{ $item->id_matkul }}
                                            @else
                                                {{ $item->kegiatan_a4 }}
                                            @endif
                                        </td>
                                        @if ($item->id_matkul)
                                            <td>{{ 'Matkul' }}</td>
                                        @else
                                            <td>{{ 'Kegiatan' }}</td>
                                        @endif
                                        <td>{{ $item->nama_pj }}</td>
                                        <td>
                                            <a href="/admin/4a/valid/{{ $item->id_a4 }}" class="text-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <!--end /div-->
                </div>
                <div class="tab-pane fade" id="Tolak" role="tabpanel" aria-labelledby="pills-tolak-tab">
                    <div class="table-responsive browser_users">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">No</th>
                                    <th class="border-top-0">Tanggal Pelaporan</th>
                                    <th class="border-top-0">Kegiatan/Matkul</th>
                                    <th class="border-top-0">Penanggung Jawab</th>
                                    <th class="border-top-0">File Bukti</th>
                                    <th class="border-top-0">Catatan Revisi</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($laporan_ditolak as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->updated_on }}</td>
                                        @if ($item->id_matkul)
                                            <td>{{ 'Matkul' }}</td>
                                        @else
                                            <td>{{ 'Kegiatan' }}</td>
                                        @endif
                                        <td>{{ $item->nama_pj }}</td>
                                        <td>
                                            <span class="badge badge-soft-primary">{{ $item->file_a4 }}</span>
                                        </td>
                                        <td>{{ $item->catatan_revisi }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <!--end /div-->
                </div>
            </div>
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->

    {{-- modals --}}
    <div class="modal fade" id="exampleModalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalSuccess1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h6 class="modal-title m-0 text-white" id="exampleModalSuccess1">Validasi</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times text-white"></i></span>
                    </button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 text-center align-self-center">
                            <img src="{{ URL::asset('images/widgets/btc.png') }}" alt="" class="img-fluid">
                        </div>
                        <!--end col-->
                        <div class="col-lg-9">
                            {{-- <h5>Crypto Market Services</h5>
                            <span class="badge bg-soft-secondary">Disable Services</span>
                            <small class="text-muted ml-2">07 Oct 2020</small>
                            <ul class="mt-3 mb-0">
                                <li>Lorem Ipsum is dummy text.</li>
                                <li>It is a long established reader.</li>
                                <li>Contrary to popular belief, Lorem simply.</li>
                            </ul> --}}
                            <h5>Apakah anda yakin ingin memvalidasi laporan ini?</h5>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-success btn-sm">Valid</button>
                </div>
                <!--end modal-footer-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end modal-->
@endsection
