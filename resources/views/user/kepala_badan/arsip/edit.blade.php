@extends('user.kepala_badan.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Arsip</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('arsipKepalaBadan') }}" class="btn btn-md btn-info mb-2">Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('updateArsipKepalaBadan', $arsip->id)}}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">
                                        Pengelola
                                        <span style="color:red">*</span>
                                    </label>
                                    <select name="pengelola" id="pengelola" class="form-control">
                                        <option value="">-- PILIH PENGELOLA --</option>
                                        <option value="1" {{$arsip->pengelola == 1 ? 'selected' : ''}}>Kepala Badan</option>
                                        <option value="2" {{$arsip->pengelola == 2 ? 'selected' : ''}}>Sekretaris</option>
                                        <option value="3" {{$arsip->pengelola == 3 ? 'selected' : ''}}>Bidang Anggaran</option>
                                        <option value="4" {{$arsip->pengelola == 4 ? 'selected' : ''}}>Bidang Perbendaharaan</option>
                                        <option value="5" {{$arsip->pengelola == 5 ? 'selected' : ''}}>Bidang Akuntansi</option>
                                        <option value="6" {{$arsip->pengelola == 6 ? 'selected' : ''}}>Bidang Aset</option>
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
                                        <option value="1" {{$arsip->jenis_dokumen == 1 ? 'selected' : ''}}>Peraturan</option>
                                        <option value="2" {{$arsip->jenis_dokumen == 2 ? 'selected' : ''}}>APBD</option>
                                        <option value="3" {{$arsip->jenis_dokumen == 3 ? 'selected' : ''}}>Laporan Keuangan</option>
                                        <option value="4" {{$arsip->jenis_dokumen == 4 ? 'selected' : ''}}>Presentasi / Slide</option>
                                        <option value="5" {{$arsip->jenis_dokumen == 5 ? 'selected' : ''}}>Dokumen Lainnya</option>
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
                                    <input type="date" name="tanggal_dokumen" class="form-control" value="{{ $arsip->tanggal_dokumen }}">
                                    @error('tanggal_dokumen')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                               </div>
                               <div class="col-6">
                                    <label for="">
                                        Nomor Dokumen
                                    </label>
                                    <input type="text" name="nomor_dokumen" cols="3" class="form-control"  value="{{ $arsip->nomor_dokumen }}"></input>
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
                                <input type="text" name="asal_dokumen" cols="3" class="form-control"  value="{{ $arsip->asal_dokumen }}"></input>
                                @error('asal_dokumen')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Perihal
                                    <span style="color:red">*</span>
                                </label>
                                <textarea name="perihal" id="perihal" class="form-control" rows="2">{{ $arsip->perihal }}</textarea>
                                @error('perihal')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Upload Dokumen
                                </label>
                                <input type="file" name="file" class="form-control h-100">
                                @error('file_path')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                @if($arsip->file_path)
                                    <p><strong>File Saat Ini:</strong> {{ basename($arsip->file_path) }}</p>
                                @endif
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

