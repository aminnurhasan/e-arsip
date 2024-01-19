<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>AdminLTE 3 | Starter</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <script src="https://kit.fontawesome.com/c1a40582b4.js" crossorigin="anonymous"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11"> --}}

  {{-- Datatables --}}
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

  <style>
    .info-box-text{
      font-size: 14px;
    }

    .info-box-number{
      font-size: 18px;
    }
    .info-box-content{
      max-height: 50px;
    }

    .custom-icon{
      font-size: 24px;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini">
  @include('sweetalert::alert')
<div class="wrapper">  
  <!-- Navbar -->
  @include('user.sekretaris.subbag_perencanaan.layouts.navbar')
  <!-- /.navbar -->

  <!-- Sidebar -->
  @include('user.sekretaris.subbag_perencanaan.layouts.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>

  <!-- Main Footer -->
  @include('user.sekretaris.subbag_perencanaan.layouts.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

{{-- Ionicons --}}
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

{{-- <script src="{{asset('sweetalert2-11.10.2/dist/sweetalert2.all.min.js')}}"></script> --}}

{{-- Datatables --}}
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script>
  $(function () {
    $('#datatable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#datatable2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

{{-- <script>
    $(document).ready(function(){
        $('#btnSimpanAgenda').on('click', function(){
            var formData = $('#formCreateAgenda').serialize();
            // var formData = new FormData($('#formCreateAgenda')[0]);
            // formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/superadmin/user/store",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Agenda Berhasil Ditambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#modalCreateAgenda').modal('hide');
                },
                error: function(error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data Agenda Gagal Ditambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // console.log(error);
                }
            });
        });
    });
</script> --}}
</body>
</html>