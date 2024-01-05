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
                                            <a href='{{ url('/superadmin/user/' . $item->id . '/edit') }}' class="btn btn-warning btn-sm fa-solid fa-pen-to-square"></a>
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