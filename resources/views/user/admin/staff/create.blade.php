@extends('user.admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Staff</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('staffAdmin') }}" class="btn btn-md btn-info mb-2">Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('storeStaffAdmin')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">NIP</label>
                                    <input type="text" name="nip" class="form-control" value="{{ old('nip') }}">
                                    @error('nip')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">Email</label>
                                    <input type="email" name="email" cols="3" class="form-control"  value="{{ old('email') }}"></input>
                                    @error('email')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="">Jabatan</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="">-- Pilih Jabatan --</option>
                                        @if (auth()->user()->role == 19)
                                            <option value="24">Staff Bagian Perencanaan & Evaluasi</option>
                                            <option value="25">Staff Bagian Keuangan</option>
                                            <option value="26">Staff Bagian Umum & Kepegawaian</option>
                                        @elseif (auth()->user()->role == 20)
                                            <option value="27">Staff Bidang Anggaran Pendapatan & Pembiayaan</option>
                                            <option value="28">Staff Bidang Anggaran Belanja</option>
                                        @elseif (auth()->user()->role == 21)
                                            <option value="29">Staff Bidang Pengelolaan Kas</option>
                                            <option value="30">Staff Bidang Administrasi Perbendaharaan</option>
                                        @elseif (auth()->user()->role == 22)
                                            <option value="31">Staff Bidang Pembukuan & Pelaporan</option>
                                            <option value="32">Staff Bidang Verifikasi</option>
                                        @elseif (auth()->user()->role == 23)
                                            <option value="33">Staff Bidang Perencanaan & Penatausahaan</option>  
                                            <option value="34">Staff Bidang Penggunaan & Pemanfaatan</option>  
                                        @endif
                                    </select>
                                    @error('role')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
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

