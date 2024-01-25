@extends('user.kepala_badan.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Detail Data Laporan</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('laporanKepalaBadan') }}" class="btn btn-md btn-info mb-2">Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="">Tanggal Dokumen</label>
                                <input type="text" name="tanggal_dokumen" disabled class="form-control" value="{{ \Carbon\Carbon::parse($agenda->tanggal_dokumen)->format('d M Y') }}">
                            </div>
                            <div class="col-6">
                                <label for="">Nomor Dokumen</label>
                                <input type="text" name="nomor_dokumen" disabled class="form-control" value="{{ $agenda->nomor_dokumen }}">                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="">Asal Dokumen</label>
                                <input type="text" name="asal_dokumen" disabled class="form-control" value="{{ $agenda->asal_dokumen }}">
                            </div>
                            <div class="col-6">
                                <label for="">Disposisi Untuk</label>
                                <input type="text" name="dis" disabled class="form-control" value="{{ $dis }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Perihal</label>
                            <input type="text" name="perihal" disabled class="form-control"  value="{{ $agenda->perihal }}"></input>
                        </div>
                        <div class="form-group">
                            <label for="">Catatan</label>
                            <textarea name="catatan" disabled class="form-control" rows="2">{{ $disposisi->catatan }}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">                            
                                <a href="{{asset('storage/' .$agenda->file_path)}}" class="btn btn-info form-control">Unduh Dokumen</a>
                            </div>
                            <div class="col-6">
                                <a href="{{asset('storage/' .$disposisi->laporan)}}" class="btn btn-info form-control">Unduh Laporan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection

