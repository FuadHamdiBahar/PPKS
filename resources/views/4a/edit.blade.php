@extends('layouts.form_main')

@section('container')
    <div class="row">
        <div class="col-lg-8">
            <form action="/4a/{{ $data->id_a4 }}" enctype="multipart/form-data" method="post">
                @method('put')
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
                                <select class="select2 form-control" id="kegiatan_a4" name="kegiatan_a4">
                                    <option
                                        {{ old('kegiatan_a4', $data->kegiatan_a4) == 'Anti Korupsi' ? 'selected' : '' }}>
                                        Anti Korupsi
                                    </option>
                                    <option
                                        {{ old('kegiatan_a4', $data->kegiatan_a4) == 'Anti Perundungan' ? 'selected' : '' }}>
                                        Anti
                                        Perundungan
                                    </option>
                                    <option
                                        {{ old('kegiatan_a4', $data->kegiatan_a4) == 'Anti Intoleransi' ? 'selected' : '' }}>
                                        Anti
                                        Intoleransi
                                    </option>
                                    <option
                                        {{ old('kegiatan_a4', $data->kegiatan_a4) == 'Anti Kekerasan Seksual' ? 'selected' : '' }}>
                                        Anti
                                        Kekerasan
                                        Seksual</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Program Studi</label>
                            <div class="col-lg-9 col-xl-8">
                                <select class="select2 form-control" id="id_sms" name="id_sms">
                                    @foreach ($program_studi as $item)
                                        @if (old('id_sms', $data->id_sms) == $item->id_sms)
                                            <option value="{{ $item->id_sms }}" selected>
                                                {{ $item->nm_prodi }} -
                                                {{ $item->jenjang }}</option>
                                        @else
                                            <option value="{{ $item->id_sms }}">{{ $item->nm_prodi }} -
                                                {{ $item->jenjang }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($data->id_kurikulum)
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label" for="id_kurikulum">Kurikulum</label>
                                <div class="col-lg-9 col-xl-8">
                                    <select class="select2 form-control" id="id_kurikulum" name="id_kurikulum">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label" for="id_matkul">Mata
                                    Kuliah</label>
                                <div class="col-lg-9 col-xl-8">
                                    <select class="select2 form-control" id="id_matkul" name="id_matkul">
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Nama Kegiatan</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input class="form-control" type="text" name="kegiatan_a4" id="kegiatan_a4"
                                        value="{{ old('kegiatan_a4', $data->kegiatan_a4) }}">
                                    @error('kegiatan_a4')
                                        <p class="text-danger pl-2">Nama Kegiatan perlu diisi</p>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Berlaku</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="date" class="form-control" id="" name="tgl_berlaku"
                                    value="{{ old('tgl_berlaku', $data->tgl_berlaku) }}">
                                @error('tgl_berlaku')
                                    <p class="text-danger">Tanggal berlaku perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Berakhir</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="date" id="" name="tgl_kadaluarsa"
                                    value="{{ old('tgl_kadaluarsa', $data->tgl_kadaluarsa) }}">
                                @error('tgl_kadaluarsa')
                                    <p class="text-danger">Tanggal kadaluarsa perlu diisi</p>
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
                                    value="{{ old('noreg_pj', $data->noreg_pj) }}">
                                @error('noreg_pj')
                                    <p class="text-danger pl-2">NIDN perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Nama</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" name="nama_pj"
                                    value="{{ old('nama_pj', $data->nama_pj) }}">
                                @error('nama_pj')
                                    <p class="text-danger pl-2">Nama perlu diisi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">No. HP</label>
                            <div class="col-lg-9 col-xl-8">
                                <input class="form-control" type="text" placeholder="+62" name="nohp_pj"
                                    value="{{ old('nohp_pj', $data->nohp_pj) }}">
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
                                            value="{{ old('file_a4', $data->file_a4) }}">
                                    </div>
                                </div>
                                @error('file_a4')
                                    {{-- <p class="text-danger pl-2">Belum ada file yang di unggah</p> --}}
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9 col-xl-8 offset-lg-3 offset-xl-3">
                                <button type="submit" class="btn btn-block btn-secondary">PERBARUI LAPORAN</button>
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

@section('script')
    <script>
        var old = {!! json_encode($data) !!}
        console.log(old);

        var kurikulum = {!! json_encode($kurikulum) !!}
        console.log(kurikulum);

        var matkul = {!! json_encode($matkul) !!}
        console.log(matkul);

        if (old) {
            $("#id_kurikulum").empty();
            for (let i = 0; i < kurikulum.length; i++) {
                const element = kurikulum[i];
                if (old['id_kurikulum'] == element['id_kurikulum_sp']) {
                    $("#id_kurikulum").append("<option value='" + element['id_kurikulum_sp'] + "' selected>" +
                        element['nm_kurikulum_sp'] + "</option>");
                } else {
                    $("#id_kurikulum").append("<option value='" + element['id_kurikulum_sp'] + "'>" +
                        element['nm_kurikulum_sp'] + "</option>");
                }
            }

            $("#id_matkul").empty();
            for (let i = 0; i < matkul.length; i++) {
                const element = matkul[i];
                console.log(element);
                if (old['id_matkul'] == element['id_mk']) {
                    $("#id_matkul").append("<option value='" + element['id_mk'] + "' selected>" +
                        element['nm_mk'] + "</option>");
                } else {
                    $("#id_matkul").append("<option value='" + element['id_mk'] + "'>" +
                        element['nm_mk'] + "</option>");
                }
            }
        }
    </script>
@endsection
