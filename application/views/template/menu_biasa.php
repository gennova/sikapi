<ul class="navbar-nav navbar-sidenav">
          <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="<?php echo base_url();?>unit/kas">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">
                Dashboard</span>
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
                <a href="<?php echo base_url('unit/kas/buku_kas'); ?>">Buku Kas</a>
              </li>
              <li>
                <a href="<?php echo base_url('unit/kas_bank'); ?>">Buku Kas Bank</a>
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
                <a href="<?php echo base_url('unit/kas/daftar_kas_con'); ?>">Daftar Kas</a>
              </li>
              <li>
                <a href="<?php echo base_url('unit/kas_bank/daftar_kas_con'); ?>">Daftar Kas Bank</a>
              </li>
            </ul>
          </li>         
        </ul>