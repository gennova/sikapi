<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });    
  });
  </script>
<?php 
if(!$this->session->userdata('logged_in') && $this->session->userdata('level') != 1){
      redirect('login', 'refresh');
    }
$this->view('template/head');
$this->view('template/js');
?>
  <body class="fixed-nav" id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="#">Administrator</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      <?php $this->view('template/menu');;?>  
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="messagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-envelope"></i>
              <span class="d-lg-none">Messages
                <span class="badge badge-pill badge-primary">12 New</span>
              </span>
              <span class="new-indicator text-primary d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
                <span class="number">12</span>
              </span>
            </a>
            <?php //include('template/message.php');?>
          </li>
          <?php $this->view('template/notif');;?>
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-fw fa-sign-out"></i>
              Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="content-wrapper py-3">

      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>            
          </li>
          <li class="breadcrumb-item active"><?php echo 'Selamat datang '.$this->session->userdata('nama_user');?></li>          
        </ol>
        MENAMBAHKAN DATA KAS BANK
        <?php echo form_open('kas/kas_bank/add_proc',array('id' => 'tambah','name' => 'tambah', 'class' => 'form-horizontal')); ?>
       <?php echo validation_errors(); ?>
        <table>
        <tr><td><div class="form-group">
            <label for="tanggal">Tanggal</label>
            <div>
              <input type="text" id="datepicker" name='tanggal'>
            </div>
            </div>
            </td>
            <td><div class="form-group">
            <label for="jeniskas">Jenis Kas</label>
            <div>
              <select class="form-control" name="idjeniskas" onchange="change(this)">
            <option value="">--- Pilih Jenis Kas ---</option>
           <?php 
           foreach($daftarkas as $jeniskas)
            { 
                echo '<option value="'.$jeniskas->id.'">'.$jeniskas->nama_jenis_kas.'</option>';
            } ?>
            </select>

            </div>
            </div>
            </td>
            </tr>
            <tr>
            <td><div class="form-group">
            <label for="nomor">Nomor</label>
            <?php
            $data = array('name' => 'nomor', 'id' => 'nomor', 'class' => 'form-control', 'placeholder' => 'Masukkan Nomor');
           echo form_input($data); ?>
                </div>
            </td>
            <td width=600><div class="form-group">
            <label for="uraian">Uraian</label>
            <?php
            $data = array('name' => 'uraian', 'id' => 'uraian', 'class' => 'form-control', 'placeholder' => 'Masukkan Uraian');
           echo form_input($data); ?>
                </div>
            </td>
        </tr>
        <tr>
        <td><div class="form-group">
            <label for="nobt">Nomor Bt.</label>
            <?php
            $data = array('name' => 'nobt', 'id' => 'nobt', 'class' => 'form-control', 'placeholder' => 'Masukkan No.Bt');
           echo form_input($data); ?>
                </div>
            </td>
            <td><div class="form-group">
            <label for="namabank">Nama bank</label>
            <?php
            $data = array('name' => 'namabank', 'id' => 'namabank', 'class' => 'form-control', 'placeholder' => 'Masukkan Nama Bank');
           echo form_input($data); ?>
                </div>
            </td>
            </tr>
        <tr>
        <td><div class="form-group">
            <label for="transaksi">Jenis Transaksi</label>
            <select class="form-control" name="transaksi" onchange="change(this)">
              <option value="debet">DEBET</option>;
              <option value="kredit">KREDIT</option>;
            </select>
                </div>
            </td>
            </td>
            <td><div class="form-group">
            <label for="rekening">Nomor Rekening Bank</label>
            <?php
            $data = array('name' => 'rekening', 'id' => 'rekening', 'class' => 'form-control', 'placeholder' => 'Masukkan Rekening Bank');
           echo form_input($data); ?>
                </div>
            </td>
            </tr>
            <tr>
        <td><div class="form-group">
            <label for="nominal">Nominal</label>
            <?php
            $data = array('name' => 'nominal', 'id' => 'nominal', 'class' => 'form-control', 'placeholder' => 'Masukkan Nominal');
           echo form_input($data); ?>
                </div>
            </td>
                                    <td><div class="form-group">
            <label for="unit">Nama Unit</label>
            <div>
              <select class="form-control" name="unit" onchange="change(this)">
            <option value="">--- Pilih Nama Unit ---</option>
           <?php 
           foreach($units as $unit)
            { 
                echo '<option value="'.$unit->id.'">'.$unit->namaunit.'</option>';
            } ?>
            </select>

            </div>
            </div>
            </td>
        </tr>
            <tr>
        <td><div class="form-group">
            <label for="tahunpelajaran">Tahun Pelajaran</label>
            <?php
            $data = array('name' => 'tahunpelajaran', 'id' => 'tahunpelajaran', 'class' => 'form-control', 'placeholder' => 'Masukkan Tahun Pelajaran');
           echo form_input($data); ?>
                </div>
            </td>
        </tr>
        </table>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="terkirim" class="btn btn-primary" value="1">Kirim</button>
            <button type="reset" class="btn btn-warning">Reset</button>
          </div>
        </div>
       <?php echo form_close(); ?>
          </div>
          </div>
          <div class="card-footer small text-muted">
            Updated yesterday at 11:59 PM
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Anda Ingin Logout?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Klik Logout untuk keluar dari sistem
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?php echo base_url('logout');?>">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>