@extends('user.b_perbendaharaan.subbid_administrasi.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Disposisi Agenda</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('agendaSubbidAdministrasi') }}" class="btn btn-md btn-info mb-2">Kembali</a>

                <div class="card">  
                    <div class="card-body">

                        <form action="{{ route('updateDisposisiAgendaSubbidAdministrasi', $agenda->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">Jenis Dokumen</label>
                                    <input type="text" name="jenis_dokumen" disabled class="form-control" value="{{ $agenda->jenis_dokumen }}">
                                </div>
                                <div class="col-6">
                                    <label for="disposisi">
                                        Disposisikan
                                        <span style="color:red">*</span>
                                    </label>
                                    <select name="disposisi" id="" class="form-control">
                                        <option value="">-- PILIH JABATAN --</option>
                                        <option value="24">Staff</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="tanggal_dokumen" disabled class="form-control" value="{{ \Carbon\Carbon::parse($agenda->tanggal_dokumen)->format('d M Y') }}">
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
                                    <label for="role">Perihal</label>
                                    <input type="text" name="perihal" disabled class="form-control" value="{{ $agenda->perihal }}">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea name="catatan" id="" cols="30" rows="2" class="form-control">{{ $disposisi->catatan }}</textarea>
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

