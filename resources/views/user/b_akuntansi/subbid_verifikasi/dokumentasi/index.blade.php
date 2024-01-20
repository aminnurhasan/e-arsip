@extends('user.b_akuntansi.subbid_verifikasi.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Dokumentasi</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{route('createDokumentasiSubbidVerifikasi')}}" class="btn btn-md btn-info mb-2">Tambah Dokumentasi</a>

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
                                        <td style="text-align: center">
                                            <a href='{{ route('showDokumentasiSubbidVerifikasi', $item->id) }}' class="btn btn-warning btn-sm fas fa-eye"></a>
                                            <a href="{{url('/subbid_verifikasi/dokumentasi/' . $item->id . '/edit')}}" class="btn btn-warning btn-sm fas fa-pen-to-square"></a>
                                            <form onsubmit="return confirm('Apakah Anda Ingin Menghapus Data ?')" data-confirm-delete="true" class="d-inline" 
                                            action="{{ url('subbid_verifikasi/dokumentasi/' . $item->id) }}" method="post">
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