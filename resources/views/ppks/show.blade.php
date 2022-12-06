@extends('layouts.main')


@section('container')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">{{ $sub_menu }} - {{ $semua_laporan[0]->nama_inpp }}</h4>
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
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pelaporan</th>
                            <th>Nama Kegiatan</th>
                            <th>Penanggung Jawab</th>
                            <th>File Bukti</th>
                            <th>Status</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                        <!--end tr-->
                    </thead>

                    <tbody>
                        @foreach ($semua_laporan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_on }}</td>
                                <td>{{ $item->kegiatan_ppks }}</td>
                                <td>{{ $item->nama_pj }}</td>
                                <td>{{ $item->file_dok }}</td>
                                @if ($item->status_ppks == 4)
                                    <td><span class="badge badge-soft-primary">{{ 'Ajuan Baru' }}</span></td>
                                @elseif ($item->status_ppks == 3)
                                    <td><span class="badge badge-soft-danger">{{ 'Ditolak' }}</span></td>
                                @else
                                    <td><span class="badge badge-soft-success">{{ 'Disetujui' }}</span></td>
                                @endif
                                {{-- <td><a href="/ppks/download/{{ $item->id_ppks }}/{{ $item->file_dok }}"
                                        class="btn btn-primary btn-sm text-light">
                                        <i class="fas fa-download"></i>
                                        Unduh
                                    </a>
                                </td> --}}
                            </tr>
                            <!--end tr-->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
@endsection
