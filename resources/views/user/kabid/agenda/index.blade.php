@extends('user.kabid.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Agenda</h1>
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
                            List Data Agenda
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">Tanggal</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-2">Perihal</th>
                                    <th class="col-2">Asal Dokumen</th>
                                    <th class="col-1">Laporan</th>
                                    <th class="col-1">Disposisi</th>
                                    <th class="col-1">Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agenda as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y') }}</td>

                                        <td>{{ $item->nomor_dokumen }}</td>
                                        <td>{{ $item->perihal }}</td>
                                        <td>{{ $item->asal_dokumen }}</td>
                                        <td style="text-align: center">
                                            <a href="{{url('/kabid/laporan/' . $item->id . '/upload')}}" class="btn btn-primary btn-sm ">Upload</a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{url('/kabid/agenda/' . $item->id . '/disposisi')}}" class="btn btn-success btn-sm ">Disposisikan</a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{asset('storage/' .$item->file_path)}}" download class="btn btn-primary btn-sm ">Unduh</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data Agenda Selesai
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="datatable2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">Tanggal</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-2">Perihal</th>
                                    <th class="col-2">Asal Dokumen</th>
                                    <th class="col-1">Laporan</th>
                                    <th class="col-1">Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendaSelesai as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y') }}</td>
                                        <td>{{ $item->nomor_dokumen }}</td>
                                        <td>{{ $item->perihal }}</td>
                                        <td>{{ $item->asal_dokumen }}</td>
                                        <td style="text-align: center">
                                            <a href="{{asset('storage/' .$item->laporan)}}" download class="btn btn-primary btn-sm ">Unduh</a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{asset('storage/' .$item->file_path)}}" download class="btn btn-primary btn-sm ">Unduh</a>
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