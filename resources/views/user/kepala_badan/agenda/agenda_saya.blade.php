@extends('user.kepala_badan.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Agenda Saya</h1>
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
                            List Data Agenda Saya
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">Tanggal</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-3">Perihal</th>
                                    <th class="col-2">Asal Dokumen</th>
                                    <th class="col-1">Laporan</th>
                                    <th class="col-1">Unduh</th>
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
                                            <a href="{{url('/kepalabadan/laporan/' . $item->id . '/upload')}}" class="btn btn-primary btn-sm ">Upload</a>
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
                                    <th class="col-1">Tindakan</th>
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

                                        @if ($item->tindak_lanjut == 1)
                                            <td>Tindak Lanjuti</td>
                                        @elseif ($item->tindak_lanjut == 2)
                                            <td>Koordinasikan</td>
                                        @elseif ($item->tindak_lanjut == 3)
                                            <td>Cukupi</td>
                                        @elseif ($item->tindak_lanjut == 4)
                                            <td>Hadiri</td>
                                        @endif

                                        @if ($item->tindak_lanjut == 4)
                                            <td style="text-align: center">
                                                <a href="{{asset('storage/' .$item->laporan)}}" download class="btn btn-primary btn-sm ">Unduh</a>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif

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