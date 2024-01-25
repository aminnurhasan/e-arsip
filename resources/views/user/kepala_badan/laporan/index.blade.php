@extends('user.kepala_badan.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Laporan</h1>
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
                            List Data Laporan
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">Tanggal</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-2">Asal</th>
                                    <th class="col-2">Disposisi</th>
                                    <th class="col-1">Dokumen</th>
                                    <th class="col-1">Laporan</th>
                                    <th class="col-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y') }}</td>
                                        <td>{{ $item->nomor_dokumen }}</td>
                                        <td>{{ $item->asal_dokumen }}</td>
                                        @if ($item->disposisi == 2)
                                            <td>Kepala Badan</td>
                                        @elseif ($item->disposisi == 3)
                                            <td>Sekretaris</td>
                                        @elseif ($item->disposisi == 4)
                                            <td>Bidang Anggaran</td>
                                        @elseif ($item->disposisi == 5)
                                            <td>Bidang Perbendaharaan</td>
                                        @elseif ($item->disposisi == 6)
                                            <td>Bidang Akuntansi</td>
                                        @elseif ($item->disposisi == 7)
                                            <td>Bidang Aset</td>
                                        @elseif ($item->disposisi == 8)
                                            <td>SubBag Perencanaan & Evaluasi</td>
                                        @elseif ($item->disposisi == 9)
                                            <td>SubBag Keuangan</td>
                                        @elseif ($item->disposisi == 10)
                                            <td>SubBag Umum & Kepegawaian</td>
                                        @elseif ($item->disposisi == 11)
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
                                        @else ()
                                            <td>Staff</td>
                                        @endif
                                        <td style="text-align: center">
                                            <a href="{{asset('storage/' .$item->laporan)}}" class="btn btn-primary btn-sm ">Unduh</a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{asset('storage/' .$item->file_path)}}" class="btn btn-primary btn-sm ">Unduh</a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href='{{ route('showLaporanKepalaBadan', $item->id) }}' class="btn btn-warning btn-sm">Lihat</a>
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