@extends('layouts.main')

@section('container')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">{{ session()->get('namalengkap') }}</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                    <div class="dropdown">
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">No</a>
                            <a class="dropdown-item" href="#">Jenjang</a>
                            <a class="dropdown-item" href="#">Anti Korupsi</a>
                            <a class="dropdown-item" href="#">Anti Kekerasan Seksual</a>
                            <a class="dropdown-item" href="#">Anti Perundungan</a>
                            <a class="dropdown-item" href="#">Anti Intoleransi</a>
                            <a class="dropdown-item" href="#">Aksi</a>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-header-->
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th class="border-top-0">No</th>
                        <th class="border-top-0">Tanggal Pelaporan</th>
                        <th class="border-top-0">Kegiatan/Matkul</th>
                        <th class="border-top-0">Penanggung Jawab</th>
                        <th class="border-top-0">File Bukti</th>
                        <th class="border-top-0">Status</th>
                        {{-- <th class="border-top-0">Aksi</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($semua_laporan as $item)
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
                                {{ $item->file_a4 }}
                            </td>
                            @if ($item->status_a4 == 4)
                                <td><span class="badge badge-soft-primary">{{ 'Ajuan Baru' }}</span></td>
                            @elseif ($item->status_a4 == 3)
                                <td><span class="badge badge-soft-danger">{{ 'Ditolak' }}</span></td>
                            @else
                                <td><span class="badge badge-soft-success">{{ 'Disetujui' }}</span></td>
                            @endif
                            {{-- <td><a href="/4a/download/{{ $item->id_a4 }}/{{ $item->file_a4 }}"
                                    class="btn btn-primary btn-sm text-light">
                                    <i class="fas fa-download"></i>
                                    Unduh
                                </a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
@endsection
