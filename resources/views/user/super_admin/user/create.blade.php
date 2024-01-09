@extends('user.super_admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">User</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <a href="{{ url()->previous() }}" class="btn btn-md btn-primary mb-2">Kembali</a>

                <div class="card">
                    <div class="card-body">

                        <form action="{{route('storeUserSuperAdmin')}}" method="post" enctype="multipart/form-data">
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
                                        <option value="1">Super Admin</option>
                                        <option value="2">Kepala Badan</option>
                                        <option value="3">Sekretaris</option>
                                        <option value="4">Kepala Bidang Anggaran</option>
                                        <option value="5">Kepala Bidang Perbendaharaan</option>
                                        <option value="6">Kepala Bidang Akuntansi</option>
                                        <option value="7">Kepala Bidang Aset</option>
                                        <option value="8">Kepala Sub Bagian Perencanaan dan Evaluasi</option>
                                        <option value="9">Kepala Sub Bagian Keuangan</option>
                                        <option value="10">Kepala Sub Bagian Umum dan Kepegawaian</option>
                                        <option value="11">Kepala Sub Bidang Anggaran Pendapatan dan Pembiayaan</option>
                                        <option value="12">Kepala Sub Bidang Anggaran Belanja</option>
                                        <option value="13">Kepala Sub Bidang Pengelolaan Kas</option>
                                        <option value="14">Kepala Sub Bidang Administrasi Perbendaharaan</option>
                                        <option value="15">Kepala Sub Bidang Pembukuan dan Pelaporan</option>
                                        <option value="16">Kepala Sub Bidang Verifikasi</option>
                                        <option value="17">Kepala Sub Bidang Perencanaan dan Penatausahaan</option>
                                        <option value="18">Kepala Sub Bidang Penggunaan dan Pemanfaatan</option>
                                        <option value="19">Admin Pembantu Sekretaris</option>
                                        <option value="20">Admin Pembantu Bidang Anggaran</option>
                                        <option value="21">Admin Pembantu Bidang Perbendaharaan</option>
                                        <option value="22">Admin Pembantu Bidang Akuntansi</option>
                                        <option value="23">Admin Pembantu Bidang Aset</option>
                                    </select>
                                    @error('role')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection

