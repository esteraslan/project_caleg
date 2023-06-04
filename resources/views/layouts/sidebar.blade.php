<aside class="main-sidebar sidebar-light-gray elevation-2">
    <a href="index3.html" class="brand-link border-0">
        <img src="dist/img/bar-chart.png" alt="AdminLTE Logo" class="brand-image">
        <span class="brand-text font-weight-dark"><b>SiP</b>2</span>
    </a>
    
    <div class="sidebar">
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if (auth()->user()->level == 'Relawan')
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                Beranda
                </p>
            </a>
        </li>
        <li class="nav-header">APPLICATIONS</li>
        <li class="nav-item">
            <a href="{{ route('pendukung.index') }}" class="nav-link {{ Request::is('pendukung') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Data Pendukung
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dpt.index') }}" class="nav-link {{ Request::is('dpt') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-tag"></i>
                <p>
                    DPT
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('survey.index') }}" class="nav-link {{ Request::is('survey') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Survey
                </p>
            </a>
        </li>
        @elseif (auth()->user()->level == 'Saksi')
        <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
            Beranda
            </p>
        </a>
        </li>
        <li class="nav-header">APPLICATIONS</li>
        <li class="nav-item">
            <a href="{{ route('quick.index') }}" class="nav-link {{ Request::is('quick') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                    Quick Count
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('real.index') }}" class="nav-link {{ Request::is('real') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    Real Count
                </p>
            </a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Beranda
            </p>
          </a>
        </li>
        <li class="nav-header">APPLICATIONS</li>
        <li class="nav-item {{ Request::is('paslon','tps','relawan','pendukung','saksi') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('paslon','tps','relawan','pendukung','saksi') ? 'active' : '' }}">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                  Master Data
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>    
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('paslon.index') }}" class="nav-link {{ Request::is('paslon') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-address-card"></i>
                      <p>
                          Data Paslon
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('tps.index') }}" class="nav-link {{ Request::is('tps') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-store"></i>
                      <p>
                          Data TPS
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('relawan.index') }}" class="nav-link {{ Request::is('relawan') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                          Data Relawan
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('pendukung.index') }}" class="nav-link {{ Request::is('pendukung') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                          Data Pendukung
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('saksi.index') }}" class="nav-link {{ Request::is('saksi') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-user-secret"></i>
                      <p>
                          Data Saksi
                      </p>
                  </a>
              </li>
          </ul>
        </li>
        <li class="nav-item {{ Request::is('dpt','survey','quick','real') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('dpt','survey','quick','real') ? 'active' : '' }}">
              <i class="nav-icon fas fa-laptop"></i>
              <p>
                  Transaksi
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>  
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('dpt.index') }}" class="nav-link {{ Request::is('dpt') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-user-tag"></i>
                      <p>
                          DPT
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('survey.index') }}" class="nav-link {{ Request::is('survey') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-chart-pie"></i>
                      <p>
                          Survey
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('quick.index') }}" class="nav-link {{ Request::is('quick') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                          Quick Count
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('real.index') }}" class="nav-link {{ Request::is('real') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-chart-bar"></i>
                      <p>
                          Real Count
                      </p>
                  </a>
              </li>
          </ul>
        </li>
        <li class="nav-item {{ Request::is('orderitem','inbarang','outbarang') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('orderitem','inbarang','outbarang') ? 'active' : '' }}">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                  Logistik
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('orderitem.index') }}" class="nav-link {{ Request::is('orderitem') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>Order Barang</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('inbarang.index') }}" class="nav-link {{ Request::is('inbarang') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-truck"></i>
                      <p>Penerimaan Barang</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('outbarang.index') }}" class="nav-link {{ Request::is('outbarang') ? 'active' : '' }}">
                      <i class="fas fa-truck-loading nav-icon"></i>
                      <p>Pengeluaran Barang</p>
                  </a>
              </li>
          </ul>
        </li>
        <li class="nav-item {{ Request::is('rekapdpt','rekapsurvey','rekapquick','rekapreal','stokbarang') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('rekapdpt','rekapsurvey','rekapquick','rekapreal','stokbarang') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-area"></i>
              <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>    
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('rekapdpt.index') }}" class="nav-link {{ Request::is('rekapdpt') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-people-arrows"></i>
                      <p>
                          Rekap DPT
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('rekapsurvey.index') }}" class="nav-link {{ Request::is('rekapsurvey') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-comments"></i>
                      <p>
                          Rekap Survey
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('rekapquick.index') }}" class="nav-link {{ Request::is('rekapquick') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-chart-area"></i>
                      <p>
                          Rekap Quick Count
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('rekapreal.index') }}" class="nav-link {{ Request::is('rekapreal') ? 'active' : '' }}">
                      <i class="nav-icon far fa-chart-bar"></i>
                      <p>
                          Rekap Real Count
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('stokbarang.index') }}" class="nav-link {{ Request::is('stokbarang') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-warehouse"></i>
                      <p>
                          Stok Logistik
                      </p>
                  </a>
              </li>
          </ul>
        </li>
        <li class="nav-header">CONFIGURATIONS</li>
        <li class="nav-item">
          <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                  Manajemen User
              </p>
          </a>
        </li>
        @endif
        </ul>
      </nav>
    </div>
</aside>