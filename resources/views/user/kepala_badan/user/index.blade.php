@extends('user.kepala_badan.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data User</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data User
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-0">No</th>
                                    <th class="col-2">NIP</th>
                                    <th class="col-3">Nama</th>
                                    <th class="col-2">Email</th>
                                    <th class="col-3">Jabatan</th>
                                    <th class="col-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
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