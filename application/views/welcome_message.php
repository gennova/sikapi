<!DOCTYPE html>
<html lang="en">
<?php if(!$this->session->userdata('logged_in')){
      redirect('login', 'refresh');
}
if($this->session->userdata('level')!=1){
      redirect('login', 'refresh');
}

include('template/head.php');
include('template/js.php');
?>
  <body class="fixed-nav" id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="<?php echo base_url('welcome');?>">Halaman Administrator</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      <?php include('template/menu.php');?>  
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
          <?php include('template/notif.php');?>
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
          <li class="breadcrumb-item active">Selamat Datang <?php echo $this->session->userdata('nama_user');?></li>          
        </ol>
        <!-- Example Tables Card -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i>
            Data Table Kas Seluruh Unit YPII
          </div>
          <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Unit</th>
                    <th>Tanggal</th>
                    <th>Nomor</th>                    
                    <th>Uraian</th>
                    <th>No. Bt.</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                  </tr>
                </thead>
                <tbody>
            <?php $i =1; if(!empty($allkas)) {
            $this->load->helper('fungsidate'); //kita load helper yang kita buat cukup
            foreach($allkas as $kas) : { 
            ?>
                  <tr>
                    <td><?php echo $i;?></td>  
                    <td><?php echo $kas->namaunit; ?></td>                  
                    <td><?php echo tgl_indo($kas->tanggal); ?></td>
                    <td><?php echo $kas->nomor; ?></td>
                    <td><?php echo $kas->uraian; ?></td>
                    <td><?php echo $kas->no_bt; ?></td>
                    <td><?php echo $kas->Debet; ?></td>
                    <td><?php echo $kas->Kredit; ?></td>
                    <td><?php echo $kas->Saldo; ?></td>
                  </tr>
             <?php
             $i++;
              } endforeach;}
              ?>    
                </tbody>
              </table>
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
            <a class="btn btn-primary" href="logout">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>