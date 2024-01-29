@extends('user.kabid.layouts.app')

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
                <a href="{{route('createArsipKabid')}}" class="btn btn-md btn-info mb-2">Tambah Data Arsip</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Jumlah Arsip Keseluruhan
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center;" onclick="redirectPeraturan()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-gavel custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Peraturan</span>
                                        <span class="info-box-number">{{$peraturan}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectAPBD()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-chart-column custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">APBD</span>
                                        <span class="info-box-number">{{$apbd}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectKeuangan()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-coins custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Keuangan</span>
                                        <span class="info-box-number">{{$keuangan}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectSlide()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-file-powerpoint custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Slide / PPT</span>
                                        <span class="info-box-number">{{$slide}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectLainnya()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-book custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"> Lainnya</span>
                                        <span class="info-box-number">{{$lainnya}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="info-box btn btn-light" style="display: flex; align-items: center" onclick="redirectSuratMasuk()">
                                    <span class="info-box-icon bg-info" style="max-width: 50px; max-height: 50px; height: 50px"><i class="fas fa-envelope custom-icon"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"> Surat Masuk</span>
                                        <span class="info-box-number">{{$suratMasuk}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<script>
    function redirectPeraturan() {
        window.location.href = "{{route('peraturanKabid')}}";
    }
    function redirectAPBD() {
        window.location.href = "{{route('apbdKabid')}}";
    }
    function redirectKeuangan() {
        window.location.href = "{{route('keuanganKabid')}}";
    }
    function redirectSlide() {
        window.location.href = "{{route('slideKabid')}}";
    }
    function redirectLainnya() {
        window.location.href = "{{route('lainnyaKabid')}}";
    }
    function redirectSuratMasuk() {
        window.location.href = "{{route('suratMasukKabid')}}";
    }
</script>
@endsection