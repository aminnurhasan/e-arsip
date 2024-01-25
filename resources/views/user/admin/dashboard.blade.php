@extends('user.staff.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Rangkuman Seluruh Data
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$staff}}</h3>
                                    <p>Staff</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="{{route('staffAdmin')}}" class="small-box-footer">
                                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$agenda}}</h3>
                                    <p>Agenda</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <a href="{{route('agendaAdmin')}}" class="small-box-footer">
                                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$peraturan}}</h3>
                                    <p>Peraturan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-gavel"></i>
                                </div>
                                <a href="{{route('peraturanAdmin')}}" class="small-box-footer">
                                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$apbd}}</h3>
                                    <p>APBD</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-column"></i>
                                </div>
                                <a href="{{route('apbdAdmin')}}" class="small-box-footer">
                                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$keuangan}}</h3>
                                    <p>Keuangan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <a href="{{route('keuanganAdmin')}}" class="small-box-footer">
                                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$slide}}</h3>
                                    <p>Slide</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-powerpoint"></i>
                                </div>
                                <a href="{{route('slideAdmin')}}" class="small-box-footer">
                                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$lainnya}}</h3>
                                    <p>Dokumen Lainnya</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <a href="{{route('lainnyaAdmin')}}" class="small-box-footer">
                                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$dokumentasi}}</h3>
                                    <p>Dokumentasi</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                                <a href="{{route('dokumentasiAdmin')}}" class="small-box-footer">
                                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection