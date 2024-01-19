@extends('user.sekretaris.subbag_perencanaan.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Dokumentasi</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('dokumentasiSubbagPerencanaan') }}" class="btn btn-md btn-info mb-2">Kembali</a>

                <div class="card">
                    <div class="card-body">

                        <form action="{{route('storeDokumentasiSubbagPerencanaan')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">
                                        Nama Kegiatan
                                        <span style="color:red">*</span>
                                    </label>
                                    <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan') }}">
                                    @error('nama_kegiatan')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="">
                                        Tanggal Kegiatan
                                        <span style="color:red">*</span>
                                    </label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control" value="{{ old('tanggal_kegiatan') }}">
                                    @error('tanggal_kegiatan')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror                                     
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Upload Dokumen
                                    <span style="color:red">*</span>
                                </label>
                                <input type="file" name="file[]" class="form-control h-100" multiple>
                                @error('file')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection

