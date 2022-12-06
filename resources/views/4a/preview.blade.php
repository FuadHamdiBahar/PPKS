@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Preview Laporan</h4>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <table class="table table-borderless">
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $item->id_a4 }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Program Studi</td>
                                    <td>{{ $item->prodi }}</td>
                                </tr>
                                @if ($item->kegiatan_a4)
                                    <tr>
                                        <td>Nama Kegiatan</td>
                                        <td>{{ $item->kegiatan_a4 }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>Nama Mata Kuliah</td>
                                        <td>{{ $item->nm_mk }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Jenis 4A</td>
                                    <td>
                                        @if ($item->jenis_a4 == 1)
                                            Anti Perundungan
                                        @elseif($item->jenis_a4 == 2)
                                            Anti Korupsi
                                        @elseif($item->jenis_a4 == 3)
                                            Anti Intoleransi
                                        @else
                                            Anti Kekerasan Seksual
                                        @endif
                                    </td>
                                    {{-- <td>{{ $item->kegiatan_ppks }}</td> --}}
                                </tr>
                                <tr>
                                    <td>Tanggal Berlaku</td>
                                    <td>{{ $item->tgl_berlaku }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Kadaluarsa</td>
                                    <td>{{ $item->tgl_kadaluarsa }}</td>
                                </tr>
                                <tr>
                                    <td>NIDN</td>
                                    <td>{{ $item->noreg_pj }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $item->nama_pj }}</td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>{{ $item->nohp_pj }}</td>
                                </tr>
                                <tr>
                                    <td>Nama File</td>
                                    <td>{{ $item->file_a4 }}</td>
                                </tr>
                            </table>

                        </div>

                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>

        <div class="col-lg ml-auto align-self-center">
            <div class="card">
                <div class="card-body">
                    <embed type="application/pdf" src="{{ asset('storage/a4/' . $item->id_a4 . '/' . $item->file_a4) }}"
                        width="100%" height="800"></embed>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <div class="row">
        <div class="col-lg ml-auto align-self-center">
        </div>
    </div>
@endsection
