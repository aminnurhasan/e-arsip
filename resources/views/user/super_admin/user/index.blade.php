@extends('user.super_admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">User</a></li>
                    <li class="breadcrumb-item"></li>
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

                <a href="{{ route('createUserSuperAdmin') }}" class="btn btn-md btn-primary mb-2">Tambah Data User</a>
                {{-- <button type="button" class="btn btn-secondary mb-2">Tambah Data User</button> --}}

                {{-- Modal Tambah Data User --}}
                {{-- <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Tambah Data User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('storeUserSuperAdmin') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">NIP</label>
                                        <input type="text" name="nip" class="form-control" value="{{ old('nip') }}">
                                        @error('nip')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        @error('name')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                        @error('email')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Jabatan</label>
                                        <select name="role" id="role" class="form-control" onchange="updateInputValue()">
                                            <option value="">- - - - -  Pilih Jabatan  - - - - -</option>
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
                                        </select>
                                    </div>
                                    @error('role')
                                        <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                    @enderror
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                                <script>
                                    $(document).ready(function(){
                                        $("#addUserModal").modal('show');
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div> --}}
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data User
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-0">No</th>
                                    <th class="col-2">NIP</th>
                                    <th class="col-3">Nama</th>
                                    <th class="col-2">Email</th>
                                    <th class="col-3">Jabatan</th>
                                    <th class="col-2">Status</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td class="text-center">
                                            @if ($item->status == 0)
                                                <a href="{{ route('statusUser', $item->id) }}" type="button" class="btn btn-danger">Non-aktif</a>
                                            @else
                                                <a href="{{ route('statusUser', $item->id) }}" type="button" class="btn btn-success">Aktif</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href='{{ url('/superadmin/user/' . $item->id . '/edit') }}' class="btn btn-warning btn-sm"><ion-icon name="create-outline"></ion-icon></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection