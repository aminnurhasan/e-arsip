@extends('user.kepala_badan.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Disposisi</h1>
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
                            List Data Disposisi
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">Tanggal</th>
                                    <th class="col-2">Kepada</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-2">Perihal</th>
                                    <th class="col-2">Asal Dokumen</th>
                                    <th class="col-1">Tindakan</th>
                                    <th class="col-1">Unduh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($disposisi as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y') }}</td>

                                        @if (in_array($item->disposisi, [3, 4, 5, 6, 7]))
                                            @if ($item->disposisi == 3)
                                                <td>Sekretaris</td>
                                            @elseif ($item->disposisi == 4)
                                                <td>Bidang Anggaran</td>
                                            @elseif ($item->disposisi == 5)
                                                <td>Bidang Perbendaharaan</td>
                                            @elseif ($item->disposisi == 6)
                                                <td>Bidang Akuntansi</td>
                                            @elseif ($item->disposisi == 7)
                                                <td>Bidang Aset</td>
                                            @endif
                                        @elseif (in_array($item->dp3, [3, 4, 5, 6, 7]))
                                            @if ($item->dp3 == 3)
                                                <td>Sekretaris</td>
                                            @elseif ($item->dp3 == 4)
                                                <td>Bidang Anggaran</td>
                                            @elseif ($item->dp3 == 5)
                                                <td>Bidang Perbendaharaan</td>
                                            @elseif ($item->dp3 == 6)
                                                <td>Bidang Akuntansi</td>
                                            @elseif ($item->dp3 == 7)
                                                <td>Bidang Aset</td>
                                            @endif
                                        @endif

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