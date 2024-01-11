@extends('user.super_admin.layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Agenda</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Agenda</a></li>
                    <li class="breadcrumb-item"></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <a href="{{route('createAgendaSuperAdmin')}}" class="btn btn-md btn-info mb-2">Tambah Data Agenda</a>
                
                {{-- Modal Tambah Data Agenda --}}
                {{-- <div class="modal fade" id="modalCreateAgenda">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data Agenda</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="formCreateAgenda">
                                    <div class="form-group">
                                        <label for="">
                                            Jenis Dokumen
                                            <span style="color:red">*</span>
                                        </label>
                                        <select name="jenis_dokumen" id="jenis_dokumen" class="form-control">
                                            <option value="">-- PILIH JENIS DOKUMEN --</option>
                                            <option value="surat masuk">Surat Masuk</option>
                                        </select>
                                        @error('jenis_dokumen')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">
                                            Tanggal Dokumen
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="date" name="tanggal_dokumen" class="form-control" value="{{ old('tanggal_dokumen') }}">
                                        @error('tanggal_dokumen')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">
                                            Nomor Dokumen
                                        </label>
                                        <input type="text" name="nomor_dokumen" cols="3" class="form-control"  value="{{ old('nomor_dokumen') }}"></input>
                                        @error('nomor_dokumen')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">
                                            Asal Dokumen
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="text" name="asal_dokumen" cols="3" class="form-control"  value="{{ old('asal_dokumen') }}"></input>
                                        @error('asal_dokumen')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">
                                            Perihal
                                            <span style="color:red">*</span>
                                        </label>
                                        <textarea name="perihal" id="perihal" class="form-control" rows="2"></textarea>
                                        @error('perihal')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">
                                            Upload Dokumen
                                            <span style="color:red">*</span>
                                        </label>
                                        <input type="file" name="file">
                                        @error('file_path')
                                            <span style="font-size: 12px; color:red" class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="btnSimpanAgenda">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- List Data Agenda --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data Agenda
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">Tanggal</th>
                                    <th class="col-2">Nomor</th>
                                    <th class="col-3">Perihal</th>
                                    <th class="col-2">Asal Dokumen</th>
                                    <th class="col-1">Aksi</th>
                                </tr>
                            </thead>
                                @foreach ($agenda as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_dokumen)->format('d M Y') }}</td>
                                        <td>{{ $item->nomor_dokumen }}</td>
                                        <td>{{ $item->perihal }}</td>
                                        <td>{{ $item->asal_dokumen }}</td>
                                        <td>
                                            <a href="{{asset('storage/' .$item->file_path)}}" download class="btn btn-primary btn-sm "><ion-icon name="cloud-download-outline"></ion-icon></a>
                                            <form onsubmit="return confirm('Apakah Anda Ingin Menghapus Data ?')" data-confirm-delete="true" class="d-inline" 
                                            action="{{ url('superadmin/agenda/' . $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name='submit' class="btn btn-danger btn-sm fas fa-trash-can"></button>
                                            </form>
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