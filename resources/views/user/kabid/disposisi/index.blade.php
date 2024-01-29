@extends('user.kabid.layouts.app')

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

                                        @if (in_array($item->disposisi, [11, 12, 13, 14, 15, 16, 17, 18]))
                                            @if ($item->disposisi == 11)
                                                <td>SubBid Anggaran Pendapatan & Pembiayaan</td>
                                            @elseif ($item->disposisi == 12)
                                                <td>SubBid Anggaran Belanja</td>
                                            @elseif ($item->disposisi == 13)
                                                <td>SubBid Pengelolaan Kas</td>
                                            @elseif ($item->disposisi == 14)
                                                <td>SubBid Administrasi Perbendaharaan</td>
                                            @elseif ($item->disposisi == 15)
                                                <td>SubBid Pembukuan & Pelaporan</td>
                                            @elseif ($item->disposisi == 16)
                                                <td>SubBid Verifikasi</td>
                                            @elseif ($item->disposisi == 17)
                                                <td>SubBid Perencanaan & Penatausahaan</td>
                                            @elseif ($item->disposisi == 18)
                                                <td>SubBid Penggunaan & Pemanfaatan</td>
                                            @endif
                                        @elseif (in_array($item->dp4, [11, 12, 13, 14, 15, 16, 17, 18]))
                                            @if ($item->dp4 == 11)
                                                <td>SubBid Anggaran Pendapatan & Pembiayaan</td>
                                            @elseif ($item->dp4 == 12)
                                                <td>SubBid Anggaran Belanja</td>
                                            @elseif ($item->dp4 == 13)
                                                <td>SubBid Pengelolaan Kas</td>
                                            @elseif ($item->dp4 == 14)
                                                <td>SubBid Administrasi Perbendaharaan</td>
                                            @elseif ($item->dp4 == 15)
                                                <td>SubBid Pembukuan & Pelaporan</td>
                                            @elseif ($item->dp4 == 16)
                                                <td>SubBid Verifikasi</td>
                                            @elseif ($item->dp4 == 17)
                                                <td>SubBid Perencanaan & Penatausahaan</td>
                                            @elseif ($item->dp4 == 18)
                                                <td>SubBid Penggunaan & Pemanfaatan</td>
                                            @endif
                                        @elseif (in_array($item->dp5, [11, 12, 13, 14, 15, 16, 17, 18]))
                                            @if ($item->dp5 == 11)
                                                <td>SubBid Anggaran Pendapatan & Pembiayaan</td>
                                            @elseif ($item->dp5 == 12)
                                                <td>SubBid Anggaran Belanja</td>
                                            @elseif ($item->dp5 == 13)
                                                <td>SubBid Pengelolaan Kas</td>
                                            @elseif ($item->dp5 == 14)
                                                <td>SubBid Administrasi Perbendaharaan</td>
                                            @elseif ($item->dp5 == 15)
                                                <td>SubBid Pembukuan & Pelaporan</td>
                                            @elseif ($item->dp5 == 16)
                                                <td>SubBid Verifikasi</td>
                                            @elseif ($item->dp5 == 17)
                                                <td>SubBid Perencanaan & Penatausahaan</td>
                                            @elseif ($item->dp5 == 18)
                                                <td>SubBid Penggunaan & Pemanfaatan</td>
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