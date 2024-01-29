@extends('user.staff.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Upload Laporan</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('agendaSayaStaff') }}" class="btn btn-md btn-info mb-2">Kembali</a>
                <div class="card">  
                    <div class="card-body">
                        <form action="{{ route('storeLaporanStaff', $disposisi->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
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
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="tindak_lanjut">
                                        Tindak Lanjut
                                    </label>
                                    <select name="tindak_lanjut" disabled id="tindak_lanjut" class="form-control">
                                        <option value="">-- Pilih Tindakan --</option>
                                        <option value="1" {{$agenda->tindak_lanjut == 1 ? 'selected' : ''}}>Tindak Lanjuti</option>
                                        <option value="2" {{$agenda->tindak_lanjut == 2 ? 'selected' : ''}}>Koordinasikan</option>
                                        <option value="3" {{$agenda->tindak_lanjut == 3 ? 'selected' : ''}}>Cukupi</option>
                                        <option value="4" {{$agenda->tindak_lanjut == 4 ? 'selected' : ''}}>Hadiri</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">
                                        Tanggal Kegiatan
                                    </label>
                                    <input type="date" name="tanggal_kegiatan" disabled class="form-control" value="{{$agenda->tanggal_kegiatan}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea name="catatan" id="" cols="30" rows="2" disabled class="form-control">{{ $disposisi->catatan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Upload Laporan
                                </label>
                                <input type="file" name="laporan" class="form-control h-100">
                                @error('laporan')
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

