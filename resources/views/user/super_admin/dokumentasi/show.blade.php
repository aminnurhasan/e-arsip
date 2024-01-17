@extends('user.super_admin.layouts.app')

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
            {{-- <x-notify::notify/> --}}
            <section class="col-lg-12">
                @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                    });
                </script>
                @endif

                <a href="{{ url()->previous() }}" class="btn btn-md btn-info mb-2">Kembali</a>

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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalFoto{{$foto->id}}" class="shadow">
                                        <img src="{{asset('storage/' . $foto->file)}}" alt="Dokumentasi" class="img-fluid shadow border border-5 rounded" style="width: 300px; height: 300px">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

<div class="modal fade" id="modalFoto{{ $foto->id }}" tabindex="-1" aria-labelledby="modalFotoLabel{{ $foto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset('storage/' . $foto->file) }}" alt="Foto" class="img-fluid">
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>
@endsection