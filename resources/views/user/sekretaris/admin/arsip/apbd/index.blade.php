@extends('user.sekretaris.admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Arsip (APBD)</h1>
            </div>            
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ route('arsipAdminSekretaris') }}" class="btn btn-md btn-info mb-2">Kembali</a>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data APBD
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-2">Tanggal</th>
                                    <th class="col-2">Pengelola</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-3">Perihal</th>
                                    <th class="col-2">Asal</th>
                                    <th class="col-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apbd as $item)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y')}}</td>
                                        @if ($item->pengelola == 1)
                                            <td>Kepala Badan</td>
                                        @elseif ($item->pengelola == 2)
                                            <td>Sekretaris</td>
                                        @elseif ($item->pengelola == 3)
                                            <td>Bidang Anggaran</td>
                                        @elseif ($item->pengelola == 4)
                                            <td>Bidang Perbendaharaan</td>
                                        @elseif ($item->pengelola == 5)
                                            <td>Bidang Akuntansi</td>
                                        @else ()
                                            <td>Bidang Aset</td>
                                        @endif

                                        <td>{{$item->nomor_dokumen}}</td>
                                        <td>{{$item->perihal}}</td>
                                        <td>{{$item->asal_dokumen}}</td>
                                        <td style="text-align: center">
                                            <a href="{{asset('storage/' .$item->file_path)}}" download class="btn btn-primary btn-sm "><ion-icon name="cloud-download-outline"></ion-icon></a>
                                            <a href="{{url('/admin_sekretaris/arsip/' . $item->id . '/edit')}}" class="btn btn-warning btn-sm fas fa-pen-to-square"></a>
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