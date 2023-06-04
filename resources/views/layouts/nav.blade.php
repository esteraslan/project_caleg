<nav class="main-header navbar navbar-expand navbar-white navbar-light border-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" style="color: #333; margin-right: -20px">Selamat datang di <b>Sistem Informasi Pendukung Pemilu</b> | {{auth()->user()->name}}</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="sbadmin/img/undraw_profile.svg" alt="User Avatar" width="30">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Reset Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" onclick="Logout();" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
          </a>
        </div>
      </li>
    </ul>
</nav>