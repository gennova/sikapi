<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Kas_bank extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		if(!$this->session->userdata('logged_in')&& $this->session->userdata('level') != 4){
			redirect('login', 'refresh');
		}
    $this->load->model('unit/Kas_bank_model');		
	}
  function index(){
    if($query = $this->Kas_bank_model->get_jenis_kas()) {
      $data['daftarkas'] = $query;
    }
    else {
      $data['daftarkas'] = NULL;
    }
    if($query = $this->Kas_bank_model->get_all_unit()) {
      $data['units'] = $query;
    }
    else {
      $data['units'] = NULL;
    }
      $this->load->view('unit/buku_kas_bank',$data);
  }

  function update(){
    //$this->Kas_model->set_s();
    $idunit;
    $query = $this->Kas_bank_model->get_user_unit($this->session->userdata('id_user'));
    foreach ($query as $row) {
      $idunit = $row->idunit;
    }    
    $dataparams = array(
        'id_user' => $this->session->userdata('id_user'),
        'tanggalawal' => $this->input->post('tanggalawal'),
        'tanggalakhir' => $this->input->post('tanggalakhir'),
        'jenis_kas' => $this->input->post('idjeniskas'),
        'unit' => $idunit,
        'tahunpelajaran' => $this->input->post('tahunajaran'), 
        );
        
    if($query = $this->Kas_bank_model->get_unit_by_id($idunit)) {
      $data['units'] = $query;
    }
    else {
      $data['units'] = NULL;
    }

    if($query = $this->Kas_bank_model->get_jenis_kas_byid($this->input->post('idjeniskas'))) {
      $data['jeniskass'] = $query;
    }
    else {
      $data['jeniskass'] = NULL;
    }

    if($query = $this->Kas_bank_model->laporan_kas($dataparams)) {
      $data['kasnya'] = $query;
    }
    else {
      $data['kasnya'] = NULL;
    }    
    $data['params'] =$dataparams;
    $this->load->view('unit/laporan_kas_bank',$data);
    //echo $this->session->userdata('id_user');
    //echo 'ID UNIT '.$idunit;
  }

  function daftar_kas_con(){
    if($query = $this->Kas_bank_model->get_jenis_kas()) {
      $data['daftarkas'] = $query;
    }
    else {
      $data['daftarkas'] = NULL;
    }
    if($query = $this->Kas_bank_model->get_all_unit()) {
      $data['units'] = $query;
    }
    else {
      $data['units'] = NULL;
    }
    if($query = $this->Kas_bank_model->get_tahun_ajaran()) {
      $data['tahuns'] = $query;
    }
    else {
      $data['tahuns'] = NULL;
    }
    $this->load->view('unit/daftar_kas_bank',$data);
  }

  function add(){
    if($query = $this->Kas_bank_model->get_jenis_kas()) {
      $data['daftarkas'] = $query;
    }
    else {
      $data['daftarkas'] = NULL;
    }
       $this->load->view('unit/buku_kas_bank',$data);
  }
  function add_proc(){
    $this->load->library('form_validation');
    $this->form_validation->set_message('required', '%s Harus Diisi.');
    //$this->form_validation->set_message('matches', 'Password dan Konfirmasi Password harus sama.');
    //$this->form_validation->set_message('is_unique', 'Username sudah ada.');

    $this->form_validation->set_rules('nomor', 'Nomor', 'required');
    $this->form_validation->set_rules('nobt','Nomor BT', 'required');
    //$this->form_validation->set_rules('uraian','Username', 'required|is_unique[user.username]');
    $this->form_validation->set_rules('uraian', 'Uraian', 'required');
    //$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');
    //$this->form_validation->set_rules('transak', 'Debit', 'required');
    $this->form_validation->set_rules('nominal', 'Nominal', 'required');
    $this->form_validation->set_rules('tahunpelajaran', 'Tahun Pelajaran', 'required');
    $this->form_validation->set_rules('namabank', 'Nama Bank', 'required');
    $this->form_validation->set_rules('rekening', 'Rekening Bank', 'required');
    if ($this->form_validation->run() == FALSE) {
      $this->add();
    }
    else {
      $tgl_input = date("Y-m-d");
      //echo "ID USERRRRRRRRRRRRRRRRRR". $tgl_input;
      $idunit;
      if($query = $this->Kas_bank_model->get_user_unit($this->session->userdata('id_user'))) {
         foreach ($query as $row) {
               $idunit=$row->idunit;
             }    
      }      
    }    
      $data = array(
        'id_user' => $this->session->userdata('id_user'),
        'tanggal' => $this->input->post('tanggal'),
        'nomor' => $this->input->post('nomor'),
        'uraian' => $this->input->post('uraian'),
        'no_bt' => $this->input->post('nobt'),
        'transaksi' => $this->input->post('transaksi'),
        'nominal' => $this->input->post('nominal'),
        'tgl_input' => $tgl_input,   
        'jenis_kas' => $this->input->post('idjeniskas'),
        'tahunpelajaran' => $this->input->post('tahunpelajaran'),  
        'nama_bank' =>$this->input->post('namabank'),
        'no_rekening' => $this->input->post('rekening'),
        'idunit'  =>$idunit,  
        );
      
      $this->Kas_bank_model->add_data($data);
      redirect('unit/kas');
    }
  }


//end of class
//controller/kas/Kas_bank.php