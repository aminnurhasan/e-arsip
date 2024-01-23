@extends('user.b_anggaran.admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Staff</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('staffAdminAnggaran') }}" class="btn btn-md btn-info mb-2">Kembali</a>

                <div class="card">  
                    <div class="card-body">

                        <form action="{{ route('updateStaffAdminAnggaran', $staff->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">NIP</label>
                                    <input type="text" name="nip" class="form-control" value="{{ old('nip', $staff->nip) }}">
                                </div>
                                <div class="col-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $staff->name) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $staff->email) }}">
                                </div>
                                <div class="col-6">
                                    <label for="role">Jabatan</label>
                                    <select class="form-control" id="role" name="role">
                                        @foreach($roles as $role)
                                            <option value="{{ $role['id'] }}" {{ $staff->role == $role['id'] ? 'selected' : '' }}>
                                                {{ $role['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
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

