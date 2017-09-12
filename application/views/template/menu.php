<ul class="navbar-nav navbar-sidenav">
          <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="<?php echo base_url('welcome');?>">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">
                Dashboard</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <a class="nav-link" href="#">
              <i class="fa fa-fw fa-area-chart"></i>
              <span class="nav-link-text">
                Charts</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
            <a class="nav-link" href="#">
              <i class="fa fa-fw fa-table"></i>
              <span class="nav-link-text">
                Tables</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents">
              <i class="fa fa-fw fa-wrench"></i>
              <span class="nav-link-text">
                Kas / Bank </span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
              <li>
                <a href="<?php echo base_url('kas/kas'); ?>">Buku Kas</a>
              </li>
              <li>
                <a href="<?php echo base_url('kas/kas_bank'); ?>">Buku Kas Bank</a>
              </li>
              <li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti">
              <i class="fa fa-fw fa-sitemap"></i>
              <span class="nav-link-text">
                Laporan-laporan</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseMulti">
              <li>
                <a href="<?php echo base_url('kas/kas/daftar_kas_con'); ?>">Daftar Kas</a>
              </li>
              <li>
                <a href="<?php echo base_url('kas/kas_bank/daftar_kas_con'); ?>">Daftar Kas Bank</a>
              </li>
              <li>
                <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Print Kas</a>
                <ul class="sidenav-third-level collapse" id="collapseMulti2">
                  <li>
                    <a href="<?php echo base_url('kas/kas/daftar_kas_print'); ?>">Print Kas</a>
                  </li>
                  <li>
                    <a href="#">Print Kas/Bank</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents4">
              <i class="fa fa-fw fa-wrench"></i>
              <span class="nav-link-text">
                Administrator</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents4">
              <li>
                <a href="<?php echo base_url('user/user/add');?>">Tambah Pengguna</a>
              </li>
              <li>
                <a href="<?php echo base_url('user/user');?>">Daftar Pengguna</a>
              </li>
              <li>
                <a href="#">Blank Page</a>
              </li>
              <li>
                <a href="#">Login Page</a>
              </li>
            </ul>
          </li> 
        </ul>