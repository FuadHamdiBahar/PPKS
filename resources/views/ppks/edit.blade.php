@extends('layouts.form_main')


@section('container')
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $sub_menu }}</h4>
                </div>
                <!--end card-header-->
                <form action="/ppks/{{ $data->id_ppks }}" enctype="multipart/form-data" method="post">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Instrumen</label>
                            <div class="col-lg-9 col-xl-8">
                                <select class="select2 form-control" id="id_inpp" name="id_inpp">
                                    <option selected disabled>Pilih Instrumen</option>
                                    @foreach ($instrumen as $item)
                                        @if (old('id_inpp', $data->id_inpp) == $item->id_inpp)
                                            <option value="{{ $item->id_inpp }}" selected>{{ $item->nama_inpp }}</option>
                                        @else
                                            <option value="{{ $item->id_inpp }}">{{ $item->nama_inpp }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_inpp')
                                    <p class="text-danger pl-2">Jenis Instrumen perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Nama Kegiatan</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" id="kegiatan_ppks" name="kegiatan_ppks"
                                    value="{{ old('kegiatan_ppks', $data->kegiatan_ppks) }}">
                                @error('kegiatan_ppks')
                                    <p class="text-danger pl-2">Nama kegiatan perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Berlaku</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="date" id="mdate" name="tgl_berlaku"
                                    value="{{ old('tgl_berlaku', $data->tgl_berlaku) }}">
                                @error('tgl_berlaku')
                                    <p class="text-danger pl-2">Tanggal berlaku perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Berakhir</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="date" id="" name="tgl_kadaluarsa"
                                    value="{{ old('tgl_kadaluarsa', $data->tgl_kadaluarsa) }}">
                                @error('tgl_kadaluarsa')
                                    <p class="text-danger pl-2">Tanggal kadaluarsa perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Penanggung Jawab</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">NIDN</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" id="noreg_pj" name="noreg_pj"
                                    value="{{ old('noreg_pj', $data->noreg_pj) }}">
                                @error('noreg_pj')
                                    <p class="text-danger pl-2">NIDN perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Nama</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" id="nama_pj" name="nama_pj"
                                    value="{{ old('nama_pj', $data->nama_pj) }}">
                                @error('nama_pj')
                                    <p class="text-danger pl-2">Nama perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">No. HP</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" id="nohp_pj" name="nohp_pj" placeholder="08.."
                                    value="{{ old('nohp_pj', $data->nohp_pj) }}">
                                @error('nohp_pj')
                                    <p class="text-danger pl-2">No HP perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Unggah Berkas</label>
                            <div class="col-lg-9 col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="file" id="input-file-now" class="dropify" name="file_dok" />
                                    </div>
                                </div>
                                @error('file_dok')
                                    <p class="text-danger pl-2">File perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9 col-xl-8 offset-lg-3 offset-xl-3">
                                <button type="submit" class="btn btn-block btn-secondary">KIRIM</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Persyaratan Berkas</h4>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <p>Panjang NIDN lebih kecil atau sama dengan 12 Karakter. Contoh :123456789012</p>
                    <p>Panjang No. HP lebih kecil atau sama dengan 12 Karakter. Contoh: 085111222333</p>
                    <p>Berkas berformat .pdf dengan max-size 512 KB</p>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
