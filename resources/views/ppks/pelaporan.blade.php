@extends('layouts.main')


@section('container')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <ul class="nav nav-pills-custom nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item mr-1">
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
                <div class="col d-flex flex-row-reverse">
                    <a href="/ppks/create" type="button" class="btn btn-sm btn-outline-light px-3">+ Tambah Pelaporan</a>
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
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">No</th>
                                    <th class="border-top-0">Tanggal Pelaporan</th>
                                    <th class="border-top-0">Penanggung Jawab</th>
                                    <th class="border-top-0">File Bukti</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($ajuan_laporan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->updated_on }}</td>
                                        <td>{{ $item->nama_pj }}</td>
                                        <td>{{ $item->file_dok }}</td>
                                        <td>
                                            <a href="/ppks/{{ $item->id_ppks }}/edit"
                                                class="btn btn-secondary waves=effect btn-sm">
                                                <i class="far fa-edit"></i> Ubah
                                            </a>
                                            <form action="/ppks/{{ $item->id_ppks }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger waves-effect waves-light btn-sm"
                                                    onclick="return confirm('Apakah anda ingin menghapus data?')"><i
                                                        class="far fa-trash-alt"></i> Hapus</button>
                                            </form>
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
                                        @if ($item->id_matkul)
                                            <td>{{ 'Matkul' }}</td>
                                        @else
                                            <td>{{ 'Kegiatan' }}</td>
                                        @endif
                                        <td>{{ $item->nama_pj }}</td>
                                        <td>
                                            <a href="/ppks/{{ $item->id_ppks }}/preview" class='text-primary'>
                                                Detail
                                            </a>
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
                                    <th class="border-top-0">Instrumen</th>
                                    <th class="border-top-0">Penanggung Jawab</th>
                                    <th class="border-top-0">File Bukti</th>
                                    <th class="border-top-0">Catatan Revisi</th>
                                    <th class="border-top-0">Aksi</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($laporan_ditolak as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->updated_on }}</td>
                                        <td>{{ $item->kegiatan_ppks }}</td>
                                        <td>{{ $item->nama_pj }}</td>
                                        <td>{{ $item->file_dok }}</td>
                                        <td>{{ $item->catatan_revisi }}</td>
                                        <td>
                                            <a href="/ppks/{{ $item->id_ppks }}/edit"
                                                class="btn btn-secondary waves=effect btn-sm">
                                                <i class="fas fa-redo"></i> Ajukan Kembali
                                            </a>
                                            {{-- <form action="/ppks/{{ $item->id_ppks }}/ajukan_kembali" method="post"
                                                class="d-inline">
                                                @method('put')
                                                @csrf
                                                <button class="btn btn-secondary waves=effect btn-sm">
                                                    <i class="fas fa-redo"></i> Ajukan Kembali
                                                </button>
                                            </form> --}}
                                            {{-- <form action="/ppks/{{ $item->id_ppks }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger waves-effect waves-light btn-sm"
                                                    onclick="return confirm('Apakah anda ingin menghapus data?')"><i
                                                        class="far fa-trash-alt"></i> Hapus</button>
                                            </form> --}}
                                        </td>
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
@endsection
