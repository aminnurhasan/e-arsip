@extends('user.kepala_badan.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Arsip</h1>
            </div>            
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{route('createArsipKepalaBadan')}}" class="btn btn-md btn-info mb-2">Tambah Data Arsip</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Jumlah Dokumen Keseluruhan
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center;" onclick="redirectPeraturan()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-gavel custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Peraturan</span>
                                        <span class="info-box-number">{{$peraturan}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectAPBD()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-chart-column custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">APBD</span>
                                        <span class="info-box-number">{{$apbd}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectKeuangan()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-coins custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Keuangan</span>
                                        <span class="info-box-number">{{$keuangan}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectSlide()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-file-powerpoint custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Slide / PPT</span>
                                        <span class="info-box-number">{{$slide}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectLainnya()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-book custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"> Lainnya</span>
                                        <span class="info-box-number">{{$lainnya}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Seluruh Dokumen
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-2">Tanggal</th>
                                    <th class="col-2">Jenis</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-3">Perihal</th>
                                    <th class="col-2">Asal</th>
                                    <th class="col-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arsip as $item)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y')}}</td>
                                        @if ($item->jenis_dokumen == 1)
                                            <td>Peraturan</td>
                                        @elseif ($item->jenis_dokumen == 2)
                                            <td>APBD</td>
                                        @elseif ($item->jenis_dokumen == 3)
                                            <td>Laporan Keuangan</td>
                                        @elseif ($item->jenis_dokumen == 4)
                                            <td>Presentasi / Slide</td>
                                        @else ()
                                            <td>Dokumen Lainnya</td>
                                        @endif

                                        <td>{{$item->nomor_dokumen}}</td>
                                        <td>{{$item->perihal}}</td>
                                        <td>{{$item->asal_dokumen}}</td>
                                        <td style="text-align: center">
                                            <a href="{{asset('storage/' .$item->file_path)}}" download class="btn btn-primary btn-sm "><ion-icon name="cloud-download-outline"></ion-icon></a>
                                            <a href="{{url('/kepalabadan/arsip/' . $item->id . '/edit')}}" class="btn btn-warning btn-sm fas fa-pen-to-square"></a>
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
<script>
    function redirectPeraturan() {
        window.location.href = "{{route('peraturanKepalaBadan')}}";
    }
    function redirectAPBD() {
        window.location.href = "{{route('apbdKepalaBadan')}}";
    }
    function redirectKeuangan() {
        window.location.href = "{{route('keuanganKepalaBadan')}}";
    }
    function redirectSlide() {
        window.location.href = "{{route('slideKepalaBadan')}}";
    }
    function redirectLainnya() {
        window.location.href = "{{route('lainnyaKepalaBadan')}}";
    }
</script>
@endsection