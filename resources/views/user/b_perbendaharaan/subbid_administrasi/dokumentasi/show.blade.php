@extends('user.b_perbendaharaan.subbid_administrasi.layouts.app')

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
                <a href="{{ route('dokumentasiSubbidAdministrasi') }}" class="btn btn-md btn-info mb-2">Kembali</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Dokumentasi {{$dokumentasi->nama_kegiatan}}, {{\Carbon\Carbon::parse($dokumentasi->tanggal_kegiatan)->format('d M Y')}}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($foto as $foto)
                                <div class="col-md-4 mb-2">
                                    <img src="{{asset('storage/' . $foto->file)}}" alt="Dokumentasi" class="img-fluid shadow border border-5 rounded" style="width: 300px; height: 300px">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection