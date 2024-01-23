@extends('user.sekretaris.admin.layouts.app')

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
                <a href="{{ route('staffAdminSekretaris') }}" class="btn btn-md btn-primary mb-2">Kembali</a>

                <div class="card">
                    <div class="card-body">

                        <form action="{{route('storeStaffAdminSekretaris')}}" method="post" enctype="multipart/form-data">
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
                                        <option value="24">Staff SubBag Perencanaan dan Evaluasi</option>
                                        <option value="25">Staff SubBag Keuangan</option>
                                        <option value="26">Staff SubBag Umum dan Kepegawaian</option>
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

