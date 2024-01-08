@extends('user.super_admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Agenda</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Agenda</a></li>
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

                <a href="{{ route('createAgendaSuperAdmin') }}" class="btn btn-md btn-primary mb-2">Tambah Data Agenda</a>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data Agenda
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">Tanggal</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-3">Perihal</th>
                                    <th class="col-2">Asal Dokumen</th>
                                    <th class="col-1">Aksi</th>
                                </tr>
                            </thead>
                                @foreach ($agenda as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y') }}</td>
                                        <td>{{ $item->nomor_dokumen }}</td>
                                        <td>{{ $item->perihal }}</td>
                                        <td>{{ $item->asal_dokumen }}</td>
                                        <td>
                                            <a href="{{asset('storage/' .$item->file_path)}}" download class="btn btn-primary btn-sm "><ion-icon name="cloud-download-outline"></ion-icon></a>
                                            <a href="{{route('deleteAgendaSuperAdmin', $item->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')"><ion-icon name="trash-outline"></ion-icon></a>
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