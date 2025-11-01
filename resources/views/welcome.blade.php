<!DOCTYPE html>
<html>
<head>
    @livewireStyles

@livewireScripts
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SisInvPer | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <!-- Bootstrap 3.3.7 -->
 <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ url('bower_components/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/datatables.net-bs/css/responsive.bootstrap.min.css') }}">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- Agrega esto en el <head> -->
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  {{-- Leaflet --}}
  <link rel="stylesheet" href="{{ url('bower_components/leaflet/dist/leaflet.css') }}">
     <link rel="stylesheet" href="{{url('https://unpkg.com/leaflet/dist/leaflet.css')}}" />
  <!-- jQuery 3 -->
<script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
        // Aplica dark-mode antes de que cargue el contenido
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.toggle('dark-mode');
        }
    </script>
</head>
@if(Auth::user())
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
       @include('modulos.users.cabecera')  <!--  crear cabecera -->
      @include('modulos.users.menu')  <!--  crear menu -->

      @yield('contenido')
    </div>
@else
<body class="hold-transition skin-blue sidebar-mini login-page">
    @yield('ingresar')
@endif



<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ url('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ url('bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('bower_components/moment/min/moment.min.js') }}"></script>

<script src="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('dist/js/demo.js') }}"></script>

{{-- Data Tables --}}
<script src="{{ url('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>

{{-- Sweet Alert2 --}}
<script src="{{ url('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>

{{-- Leaflet --}}
<script src="{{ url('https://unpkg.com/leaflet/dist/leaflet.js') }}"></script>

{{-- Plantillas --}}
<script src="{{ url('js/etapas.js') }}"></script>
<script src="{{ url('js/usuarios.js') }}"></script>
<script src="{{ asset('js/cedula-formato.js') }}"></script>
<script src="{{ asset('js/protagonista.js') }}"></script>
<script src="{{ asset('js/mapas.js') }}"></script>
<script src="{{ asset('js/estados.js') }}"></script>

@if (session('success'))
<script type="text/javascript">
    Swal.fire({
        icon: "success",
        title: '{{ session('success') }}',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif

<style>
.datos-lote {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: all 0.5s ease-in-out;
}

.datos-lote.show {
    max-height: 500px; /* lo suficientemente grande para el contenido */
    opacity: 1;
}
</style>

</body>
</html>
