@extends('user.staff.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Dokumentasi</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('dokumentasiStaff') }}" class="btn btn-md btn-info mb-2">Kembali</a>

                <div class="card">
                    <div class="card-body">

                        <form action="{{route('updateDokumentasiStaff', $dokumentasi->id)}}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">
                                        Nama Kegiatan
                                        <span style="color:red">*</span>
                                    </label>
                                    <input type="text" name="nama_kegiatan" class="form-control" value="{{ $dokumentasi->nama_kegiatan }}">
                                    @error('nama_kegiatan')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="">
                                        Tanggal Kegiatan
                                        <span style="color:red">*</span>
                                    </label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control" value="{{ $dokumentasi->tanggal_kegiatan }}">
                                    @error('tanggal_kegiatan')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror                                     
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Upload Dokumentasi Baru
                                </label>
                                <input type="file" name="file[]" class="form-control h-100" multiple>
                                @error('file')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Dokumentasi Sebelumnya:</strong></label>
                                <div class="row">
                                    @foreach ($dokumentasi->foto as $foto)
                                        <div class="col-md-4 mb-2">
                                            <a href="#" class="shadow">
                                                <img src="{{asset('storage/' . $foto->file)}}" alt="Dokumentasi" class="img-fluid shadow border border-5 rounded" style="width: 300px; height: 300px">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
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

