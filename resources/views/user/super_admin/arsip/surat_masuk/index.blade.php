@extends('user.super_admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Arsip (Surat Masuk)</h1>
            </div>            
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('arsipSuperAdmin') }}" class="btn btn-md btn-info mb-2">Kembali</a>
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
                            List Data Surat Masuk
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">Tanggal</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-2">Asal Dokumen</th>
                                    <th class="col-2">Perihal</th>
                                    <th class="col-1">Tindakan</th>
                                    <th class="col-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratMasuk as $item)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y')}}</td>
                                        <td>{{$item->nomor_dokumen}}</td>
                                        <td>{{$item->asal_dokumen}}</td>
                                        <td>{{$item->perihal}}</td>

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
                                            <a href="{{asset('storage/' .$item->file_path)}}" download class="btn btn-primary btn-sm"><ion-icon name="cloud-download-outline"></ion-icon></a>
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
            url: '/superadmin/filtersuratmasuk',
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
            row += '<td>' + item.nomor_dokumen + '</td>';
            row += '<td>' + item.asal_dokumen + '</td>';
            row += '<td>' + item.perihal + '</td>';
            row += '<td>';
            if (item.tindak_lanjut == 1) {
                row += 'Tindak Lanjuti';
            } else if (item.tindak_lanjut == 2) {
                row += 'Koordinasikan';
            } else if (item.tindak_lanjut == 3) {
                row += 'Cukupi';
            } else if (item.tindak_lanjut == 4) {
                row += 'Hadiri';
            }
            row += '</td>';
            row += '<td style="text-align: center">';
            row += '<a href="/storage/' + item.file_path + '" download class="btn btn-primary btn-sm mr-1"><ion-icon name="cloud-download-outline"></ion-icon></a>';
            row += '</td>';

            row += '</tr>';
            tableBody.innerHTML += row;
        });
    }
</script>
@endsection