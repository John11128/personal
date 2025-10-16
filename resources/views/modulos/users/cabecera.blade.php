<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('Inicio') }}" class="logo" style="background-color: #007005;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="background-color: #007005;"><b>SIP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="background-color: #007005;"><b>SisInvPer</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #007005;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="background-color: #003603;">
        <span class="sr-only"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
           
            <ul class="dropdown-menu">
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                   
                  <!-- end message -->
                 
                    
                  </li>
                </ul>
              </li>
              
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            
             
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               @if (auth()->user()->foto != "")
                                  <img src="{{ url('storage/'.Auth()->user()->foto) }}" class="img-circle" alt="User Image" width="20px" height="20px"
                                    class="img-thumbnail previsualizar" alt="">
                                    @else
                                      <img src="{{ url('storage/anonymous.png') }}" class="img-circle" alt="User Image" width="20px" height="20px"
                                    class="img-thumbnail previsualizar" alt="">
                                @endif
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if (auth()->user()->foto != "")
                                  <img src="{{ url('storage/'.Auth()->user()->foto) }}" class="img-circle" alt="User Image"
                                    class="img-thumbnail previsualizar" alt="">
                                    @else
                                      <img src="{{ url('storage/anonymous.png') }}" class="img-circle" alt="User Image"
                                    class="img-thumbnail previsualizar" alt="">
                                @endif

                <p>
                   {{ auth()->user()->name }} - {{ auth()->user()->roll }}
                  <small>Miembro desde {{ auth()->user()->created_at->format('d. M. Y') }}</small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('/perfil') }}" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-danger btn-flat"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                </div>
              </li>
              <form method="post" id="logout-form" action="{{ route('logout') }}" style="display: none;">
                  @csrf
              </form>
            </ul>
          </li>
          <!-- Control Sidebar menú de opciones del sistema -->
          <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Opciones de sistema">
        <i class="fa fa-gears"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="#" id="toggle-theme">
                <i class="fa fa-adjust"></i> Cambiar a <span id="theme-text">oscuro</span>
            </a>
        </li>
    </ul>
</li>
        </ul>
      </div>
    </nav>
  </header>

  <style>
/* Puedes ajustar estos estilos a tu gusto */
html.dark-mode {
    background-color: #222 !important;
    color: #f1f1f1 !important;
}
html.dark-mode body,
html.dark-mode .main-header,
html.dark-mode .navbar,
html.dark-mode .sidebar,
html.dark-mode .box,
html.dark-mode .content-wrapper,
html.dark-mode .content,
html.dark-mode .modal-content {
    background-color: #222 !important;
    color: #f1f1f1 !important;
    border-color: #555 !important;
}
html.dark-mode .box,
html.dark-mode .modal-content {
    border-color: #444 !important;
}
html.dark-mode .form-control,
html.dark-mode input,
html.dark-mode select,
html.dark-mode textarea {
    background-color: #333 !important;
    color: #f1f1f1 !important;
    border-color: #555 !important;
}
html.dark-mode .table,
html.dark-mode .DataTables_wrapper .DataTables_paginate,
html.dark-mode .table-striped > tbody > tr:nth-of-type(odd) {
    background-color: #222 !important;
    color: #f1f1f1 !important;
}
html.dark-mode .table-striped > tbody > tr:nth-of-type(even) {
    background-color: #2a2a2a !important;
}
html.dark-mode .btn,
html.dark-mode .btn-default,
html.dark-mode .btn-primary,
html.dark-mode .btn-danger,
html.dark-mode .btn-success,
html.dark-mode .btn-warning {
    background-color: #444 !important;
    color: #f1f1f1 !important;
    border-color: #555 !important;
}

/* Bordes visibles para todos los elementos principales */
html.body .box,
html.body .modal-content,
html.body .form-control,
html.body input,
html.body select,
html.body textarea,
html.body .table,
html.body .btn,
html.body .navbar,
html.body .sidebar,
html.body .content-wrapper,
html.body .content,
html.body .logo,
html.body .user-header {
    border: 1.5px solid #bbb !important;
    border-radius: 6px !important;
}

/* Bordes más notorios en modo oscuro */
html.dark-mode .box,
html.dark-mode .modal-content,
html.dark-mode .form-control,
html.dark-mode input,
html.dark-mode select,
html.dark-mode textarea,
html.dark-mode .table,
html.dark-mode .btn,
html.dark-mode .navbar,
html.dark-mode .sidebar,
html.dark-mode .content-wrapper,
html.dark-mode .content,
html.dark-mode .logo,
html.dark-mode .logo-mini,
html.dark-mode .user-header {
    border: 1.5px solid #666 !important;
    border-radius: 6px !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cargar preferencia guardada
    if(localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark-mode');
        document.getElementById('theme-text').innerText = 'claro';
    }

    document.getElementById('toggle-theme').addEventListener('click', function(e) {
        e.preventDefault();
        document.documentElement.classList.toggle('dark-mode');
        // Cambia el texto del menú
        let themeText = document.getElementById('theme-text');
        if(document.documentElement.classList.contains('dark-mode')) {
            themeText.innerText = 'claro';
            localStorage.setItem('theme', 'dark');
        } else {
            themeText.innerText = 'oscuro';
            localStorage.setItem('theme', 'light');
        }
    });
});
</script>