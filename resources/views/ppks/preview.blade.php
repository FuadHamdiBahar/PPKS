@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Validasi Laporan</h4>
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
                                    <td>{{ $item->id_ppks }}</td>
                                </tr>
                                <tr>
                                    <td>Instrumen</td>
                                    <td>{{ $item->nama_inpp }}</td>
                                </tr>
                                <tr>
                                    <td>Universitas</td>
                                    <td>{{ $item->nm_lemb }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Kegiatan</td>
                                    <td>{{ $item->kegiatan_ppks }}</td>
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
                                    <td>{{ $item->file_dok }}</td>
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
                    <embed type="application/pdf"
                        src="{{ asset('storage/ppks/' . $item->id_ppks . '/' . $item->file_dok) }}" width="100%"
                        height="800"></embed>
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
