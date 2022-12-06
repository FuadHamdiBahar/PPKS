@extends('layouts.form_main')


@section('container')
    <div class="row">
        <div class="col-lg-8">
            <form action="/4a" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $sub_menu }}</h4>
                    </div>
                    <!--end card-header-->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Jenis 4A</label>
                            <div class="col-lg-9 col-xl-8">
                                <select class="select2 form-control" id="jenis_a4" name="jenis_a4">
                                    <option selected disabled>Pilih Jenis 4A</option>
                                    <option {{ old('jenis_a4') == 'Anti Perundungan' ? 'selected' : '' }} value="1">
                                        Anti
                                        Perundungan
                                    </option>
                                    <option {{ old('jenis_a4') == 'Anti Korupsi' ? 'selected' : '' }} value="2">Anti
                                        Korupsi
                                    </option>
                                    <option {{ old('jenis_a4') == 'Anti Intoleransi' ? 'selected' : '' }} value="3">
                                        Anti
                                        Intoleransi
                                    </option>
                                    <option {{ old('jenis_a4') == 'Anti Kekerasan Seksual' ? 'selected' : '' }}
                                        value="4">Anti Kekerasan Seksual</option>
                                </select>
                                @error('jenis_a4')
                                    <p class="text-danger pl-2">Jenis Kegiatan perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Program Studi</label>
                            <div class="col-lg-9 col-xl-8">
                                <select class="select2 form-control" id="id_sms" name="id_sms">
                                    <option selected disabled>Pilih Program Studi</option>
                                    @foreach ($program_studi as $item)
                                        @if (old('id_sms') == $item->id_sms)
                                            <option value="{{ $item->id_sms }}" selected>{{ $item->nm_prodi }} -
                                                {{ $item->jenjang }}</option>
                                        @else
                                            <option value="{{ $item->id_sms }}">{{ $item->nm_prodi }} -
                                                {{ $item->jenjang }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_sms')
                                    <p class="text-danger pl-2">Program Studi perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label" for="id_kurikulum">Kurikulum</label>
                            <div class="col-lg-9 col-xl-8">
                                <select class="select2 form-control" id="id_kurikulum" name="id_kurikulum">
                                    <option selected disabled>Pilih Kurikulum</option>
                                </select>
                                @error('id_kurikulum')
                                    <p class="text-danger pl-2">Kurikulum perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label" for="id_matkul">Mata Kuliah</label>
                            <div class="col-lg-9 col-xl-8">
                                <select class="select2 form-control" id="id_matkul" name="id_matkul">
                                    <option selected disabled>Pilih Mata Kuliah</option>
                                </select>
                                @error('id_matkul')
                                    <p class="text-danger pl-2">Mata Kuliah perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label" for="">Tanggal Berlaku</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="date" class="form-control" id="" name="tgl_berlaku"
                                    value="{{ old('tgl_berlaku') }}">
                                @error('tgl_berlaku')
                                    <p class="text-danger pl-2">Tanggal berlaku perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label" for="">Project End Date</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="date" class="form-control" id="" name="tgl_kadaluarsa"
                                    value="{{ old('tgl_kadaluarsa') }}">
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
                                <input class="form-control" type="text" name="noreg_pj" id="noreg_pj"
                                    value="{{ old('noreg_pj') }}">
                                @error('noreg_pj')
                                    <p class="text-danger pl-2">NIDN perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Nama</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" name="nama_pj" value="{{ old('nama_pj') }}">
                                @error('nama_pj')
                                    <p class="text-danger pl-2">Nama perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">No. HP</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" placeholder="08" name="nohp_pj"
                                    value="{{ old('nohp_pj') }}">
                                @error('nohp_pj')
                                    <p class="text-danger pl-2">No. HP perlu diisi</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Unggah Berkas</label>
                            <div class="col-lg-9 col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <input type="file" id="input-file-now" class="dropify" name="file_a4"
                                            value="{{ old('file_a4') }}">
                                    </div>
                                </div>
                                @error('file_a4')
                                    <p class="text-danger pl-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9 col-xl-8 offset-lg-3 offset-xl-3">
                                <button type="submit" class="btn btn-block btn-secondary">BUAT LAPORAN</button>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
            </form>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Persyaratan Berkas</h4>
                </div>
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
