@extends('user.subbid.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Arsip (Dokumen Lainnya)</h1>
            </div>            
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('arsipSubbid') }}" class="btn btn-md btn-info mb-2">Kembali</a>
                    <div class="dropdown ml-auto">
                        <button class="btn btn-secondary btn-md dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter Tahun
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($years as $year)
                                <a class="dropdown-item" href="#" onclick="filterData('{{ $year }}')">{{ $year }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data Dokumen Lainnya
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
                                @foreach ($lainnya as $item)
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
                                            <a href="{{asset('storage/' .$item->file_path)}}" download class="btn btn-primary btn-sm"><ion-icon name="cloud-download-outline"></ion-icon></a>
                                            <a href="{{url('/subbid/arsip/' . $item->id . '/edit')}}" class="btn btn-warning btn-sm fas fa-pen-to-square"></a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>s
<script>
    function filterData(tahun) {
        $.ajax({
            url: '/subbid/filterlainnya',
            method: 'GET',
            data: {tahun: tahun},
            success: function(response) {
                // Handle response, misalnya memperbarui tabel dengan data baru
                updateTable(response.data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function formatDate(dateString) {
        var options = { day: '2-digit', month: 'short', year: 'numeric' };
        var formattedDate = new Date(dateString).toLocaleDateString('id-ID', options);
        return formattedDate;
    }

    function updateTable(data) {
        var tableBody = document.querySelector('.table tbody');
        tableBody.innerHTML = '';

        data.forEach(function(item) {
            var row = '<tr>';
            var formattedDate = formatDate(item.tanggal_dokumen);
            row += '<td>' + formattedDate + '</td>';
            row += '<td>' + item.pengelola + '</td>';
            row += '<td>' + item.nomor_dokumen + '</td>';
            row += '<td>' + item.perihal + '</td>';
            row += '<td>' + item.asal_dokumen + '</td>';
            row += '<td>';
            row += '<a href="/storage/' + item.file_path + '" download class="btn btn-primary btn-sm mr-1"><ion-icon name="cloud-download-outline"></ion-icon></a>';
            row += '<a href="/subbid/arsip/' + item.id + '/edit" class="btn btn-warning btn-sm fas fa-pen-to-square"></a>';
            row += '</td>';

            row += '</tr>';
            tableBody.innerHTML += row;
        });
    }
</script>
@endsection