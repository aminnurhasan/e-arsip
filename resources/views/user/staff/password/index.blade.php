@extends('user.staff.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Ganti Password</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('updatePasswordStaff', $user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">
                                        NIP
                                    </label>
                                    <input type="text" name="nip" disabled class="form-control" value="{{ $user->nip }}">
                                </div>
                                <div class="col-6">
                                    <label for="">
                                        Nama
                                    </label>
                                    <input type="text" name="name" disabled class="form-control" value="{{ $user->name }}">                
                                </div>
                            </div>
                            <div class="form-group row">
                               <div class="col-6">
                                    <label for="">
                                        Email
                                    </label>
                                    <input type="email" name="email" disabled class="form-control" value="{{ $user->email }}">
                               </div>
                               <div class="col-6">
                                    <label for="">
                                        Jabatan
                                    </label>
                                    <input type="text" name="jabatan" disabled class="form-control"  value="{{ $user->jabatan }}">
                               </div>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Password Lama
                                    <span style="color:red">*</span>
                                </label>
                                <input type="password" name="password_lama" class="form-control">
                                @error('password_lama')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Password Baru
                                    <span style="color:red">*</span>
                                </label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Konfirmasi Password Baru
                                    <span style="color:red">*</span>
                                </label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
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

