<!DOCTYPE html>
<html lang="en">
<?php 
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
          <li class="breadcrumb-item active">My Dashboard</li>          
        </ol>
        <!-- Example Tables Card -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i>
            Data Table Example
          </div>
          <div class="card-body">          
             <h1> Update/Rubah data User </h1> <br />
             <?php
             foreach ($users as $user){
              echo 'ID USER '. $user->id_user;
              ?>
       <?php echo form_open('user/user/update_proc/'.$user->id_user,array('id' => 'tambah','name' => 'tambah', 'class' => 'form-horizontal')); ?>
       <?php echo validation_errors(); ?>
       <br />
       <p class="text-danger" style="font-size:20px;"><?php echo $this->session->flashdata('pesan'); ?></p>

       
       <!-- Nama -->
        <div class="form-group">
          <label for="username" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-10">
            <?php 
           $data = array('name' => 'nama', 'id' => 'nama', 'class' => 'form-control', 'placeholder' => 'Masukkan Nama','value'=>$user->nama_user);
           echo form_input($data); ?>
          </div>
        </div>

        <!-- Username -->
        <div class="form-group">
          <label for="username" class="col-sm-2 control-label">Username</label>
          <div class="col-sm-10">
            <?php 
           $data = array('name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Masukkan Username','value'=>$user->username);
           echo form_input($data); ?>
          </div>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <?php 
           $data = array('type' => 'password', 'name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password');
           echo form_input($data); ?>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
          <label for="password2" class="col-sm-2 control-label">Konfirmasi Password</label>
          <div class="col-sm-10">
            <?php 
           $data = array('type' => 'password', 'name' => 'password2', 'id' => 'password2', 'class' => 'form-control', 'placeholder' => 'Konfirmasi Password');
           echo form_input($data); ?>
          </div>
        </div>
        
        <!-- Level-->
        <div class="form-group">
          <label for="level" class="col-sm-2 control-label">Tingkatan</label>
         <div class="col-sm-6">
          <select class="form-control" name="level" onchange="change(this)">
            <option value="">--- Pilih Tingkatan User ---</option>
           <?php 
           $id_level = $user->level;
           $status='selected';           
           foreach($levels as $level)
            { 
                if($level->id==$id_level){
                  echo '<option selected value="'.$level->id.'">'.$level->level.'</option>';
                }else {
                echo '<option value="'.$level->id.'">'.$level->level.'</option>';
              }
            } ?>
            </select>
            </div>
        </div>

        <!-- Cabang-->
        <div class="form-group">
          <label for="cabang" class="col-sm-2 control-label">Cabang</label>
         <div class="col-sm-6">
          <select class="form-control" name="cabang" onchange="change(this)">
            <option value="">--- Pilih Cabang User ---</option>
           <?php 
           $idcabang = $user->idcabang;
           foreach($cabangs as $cabang)
            { 
                if($cabang->id==$idcabang){
                    echo '<option selected value="'.$cabang->id.'">'.$cabang->namacabang.'</option>';
                }else {
                  echo '<option value="'.$cabang->id.'">'.$cabang->namacabang.'</option>';
                }
                
            } ?>
            </select>
            </div>
        </div>

        <!-- Unit-->
        <div class="form-group">
          <label for="unit" class="col-sm-2 control-label">Unit</label>
         <div class="col-sm-6">
          <select class="form-control" name="unit" onchange="change(this)">
            <option value="">--- Pilih Unit User ---</option>
           <?php 
           $idunit = $user->idunit;
           foreach($units as $unit)
            { 
              if($unit->id==$idunit){
                echo '<option selected value="'.$unit->id.'">'.$unit->namaunit.'</option>';
              }else{
                echo '<option value="'.$unit->id.'">'.$unit->namaunit.'</option>';
              }
              
            } ?>
            </select>
            </div>
        </div>          

        <br />
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="terkirim" class="btn btn-primary" value="1">Kirim</button>
            <button type="reset" class="btn btn-warning">Reset</button>
          </div>
        </div>
        <?php
      } 
      ?>
       <?php echo form_close(); ?>

        </div>
        </div>
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