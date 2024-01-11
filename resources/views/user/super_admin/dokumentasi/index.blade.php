@extends('user.super_admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Dokumentasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Dokumentasi</a></li>
                    <li class="breadcrumb-item"></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            {{-- <x-notify::notify/> --}}
            <section class="col-lg-12">
                @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                    });
                </script>
                @endif

                <a href="{{route('createDokumentasiSuperAdmin')}}" class="btn btn-md btn-info mb-2">Tambah Dokumentasi</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            List Seluruh Dokumen
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th class="col-3">Tanggal</th>
                                    <th class="col-4">Nama Kegiatan</th>
                                    <th class="col-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokumentasi as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y')}}</td>
                                        <td>{{$item->nama_kegiatan}}</td>
                                        <td>
                                            <a href='{{ route('showDokumentasiSuperAdmin', $item->id) }}' class="btn btn-warning btn-sm fas fa-eye"></a>
                                            <form onsubmit="return confirm('Apakah Anda Ingin Menghapus Data ?')" data-confirm-delete="true" class="d-inline" 
                                            action="{{ url('superadmin/dokumentasi/' . $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name='submit' class="btn btn-danger btn-sm fas fa-trash-can"></button>
                                            </form>
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