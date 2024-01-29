@extends('user.staff.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tindak Lanjut Agenda</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('agendaStaff') }}" class="btn btn-md btn-info mb-2">Kembali</a>
                <a href="{{ route('selesaikanAgendaStaff', $disposisi->id) }}" class="btn btn-md btn-success mb-2">Selesaikan</a>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('storeTindakLanjutStaff', $agenda->id) }}" method="post" enctype="multipart/form-data">
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
                                    <label for="disposisi">
                                        Disposisi
                                    </label>
                                    <select name="disposisi" disabled class="form-control">
                                        <option value="">-- PILIH JABATAN --</option>
                                        @if (auth()->user()->role == 24)
                                            <option selected>Staff SubBag Perencanaan dan Evaluasi</option>
                                        @elseif (auth()->user()->role == 25)
                                            <option selected>Staff SubBag Keuangan</option>
                                        @elseif (auth()->user()->role == 26)
                                            <option selected>Staff SubBag Umum dan Kepegawaian</option>
                                        @elseif (auth()->user()->role == 27)
                                            <option selected>Staff SubBid Anggaran Pendapatan dan Pembiayaan</option>
                                        @elseif (auth()->user()->role == 28)
                                            <option selected>Staff SubBid Anggaran Belanja</option>
                                        @elseif (auth()->user()->role == 29)
                                            <option selected>Staff SubBid Pengelolaan Kas</option>
                                        @elseif (auth()->user()->role == 30)
                                            <option selected>Staff SubBid Administrasi Perbendaharaan</option>
                                        @elseif (auth()->user()->role == 31)
                                            <option selected>Staff SubBid Pembukuan dan Pelaporan</option>
                                        @elseif (auth()->user()->role == 32)
                                            <option selected>Staff SubBid Verifikasi</option>
                                        @elseif (auth()->user()->role == 33)
                                            <option selected>Staff SubBid Perencanaan dan Penatausahaan</option>
                                        @elseif (auth()->user()->role == 34)
                                            <option selected>Staff SubBid Penggunaan dan Pemanfaatan</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="tindak_lanjut">
                                        Tindak Lanjut
                                    </label>
                                    <select name="tindak_lanjut" disabled id="tindak_lanjut" class="form-control">
                                        <option value="">-- Pilih Tindakan --</option>
                                        <option value="1" {{$tindakan == 1 ? 'selected' : ''}}>Tindak Lanjuti</option>
                                        <option value="2" {{$tindakan == 2 ? 'selected' : ''}}>Koordinasikan</option>
                                        <option value="3" {{$tindakan == 3 ? 'selected' : ''}}>Cukupi</option>
                                        <option value="4" {{$tindakan == 4 ? 'selected' : ''}}>Hadiri</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="tanggal_kegiatan" style="{{ $tindakan == 4 ? 'display: block' : 'display: none'}}">
                                <label for="">Tanggal Kegiatan</label>
                                <input type="date" class="form-control" disabled  name="tanggal_kegiatan" value="{{$agenda->tanggal_kegiatan}}">
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea name="catatan" id="" cols="30" disabled rows="2" class="form-control">{{ $disposisi->catatan }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tindak_lanjut').on('change', function() {
            var tindakLanjut = $(this).val();

            $('#tanggal_kegiatan').hide();

            if (tindakLanjut == '4') {
                $('#tanggal_kegiatan').show();
            }
        });
    });
</script>
@endsection

