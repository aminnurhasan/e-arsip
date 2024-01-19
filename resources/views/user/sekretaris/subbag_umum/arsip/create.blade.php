@extends('user.sekretaris.subbag_umum.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Dokumen</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('arsipSubbagUmum') }}" class="btn btn-md btn-info mb-2">Kembali</a>

                <div class="card">
                    <div class="card-body">

                        <form action="{{route('storeArsipSubbagUmum')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">
                                        Pengelola
                                        <span style="color:red">*</span>
                                    </label>
                                    <select name="pengelola" id="pengelola" class="form-control">
                                        <option value="">-- PILIH PENGELOLA --</option>
                                        <option value="1">Kepala Badan</option>
                                        <option value="2">Sekretaris</option>
                                        <option value="3">Bidang Anggaran</option>
                                        <option value="4">Bidang Perbendaharaan</option>
                                        <option value="5">Bidang Akuntansi</option>
                                        <option value="6">Bidang Aset</option>
                                    </select>
                                    @error('pengelola')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="">
                                        Jenis Dokumen
                                        <span style="color:red">*</span>
                                    </label>
                                    <select name="jenis_dokumen" id="jenis_dokumen" class="form-control">
                                        <option value="">-- PILIH JENIS DOKUMEN --</option>
                                        <option value="1">Peraturan</option>
                                        <option value="2">APBD</option>
                                        <option value="3">Laporan Keuangan</option>
                                        <option value="4">Presentasi / Slide</option>
                                        <option value="5">Dokumen Lainnya</option>
                                    </select>
                                    @error('jenis_dokumen')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror                                     
                                </div>
                            </div>
                            <div class="form-group row">
                               <div class="col-6">
                                    <label for="">
                                        Tanggal Dokumen
                                        <span style="color:red">*</span>
                                    </label>
                                    <input type="date" name="tanggal_dokumen" class="form-control" value="{{ old('tanggal_dokumen') }}">
                                    @error('tanggal_dokumen')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                               </div>
                               <div class="col-6">
                                    <label for="">
                                        Nomor Dokumen
                                    </label>
                                    <input type="text" name="nomor_dokumen" cols="3" class="form-control"  value="{{ old('nomor_dokumen') }}"></input>
                                    @error('nomor_dokumen')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                               </div>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Asal Dokumen
                                    <span style="color:red">*</span>
                                </label>
                                <input type="text" name="asal_dokumen" cols="3" class="form-control"  value="{{ old('asal_dokumen') }}"></input>
                                @error('asal_dokumen')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Perihal
                                    <span style="color:red">*</span>
                                </label>
                                <textarea name="perihal" id="perihal" class="form-control" rows="2"></textarea>
                                @error('perihal')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Upload Dokumen
                                    <span style="color:red">*</span>
                                </label>
                                <input type="file" name="file" class="form-control h-100">
                                @error('file_path')
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

