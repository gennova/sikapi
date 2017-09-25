<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Kas extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		if(!$this->session->userdata('logged_in') && $this->session->userdata('level') != 4){
			redirect('login', 'refresh');
		}
    $this->load->model('unit/Kas_model');		
	}
  function index(){
    $query = $this->Kas_model->laporan_kas_all($this->session->userdata('id_user'));
    $data['allkas'] = $query;
      $this->load->view('unit/welcome_unit',$data);
  }

  function buku_kas(){
    if($query = $this->Kas_model->get_jenis_kas()) {
      $data['daftarkas'] = $query;
    }
    else {
      $data['daftarkas'] = NULL;
    }    
    $data['allkas'] = $query;
      $this->load->view('unit/buku_kas',$data);
  }

  function delete_kas_unit_by_id($id_kas){
    $this->load->model('unit/Kas_model');
    $this->Kas_model->delete_kas($id_kas);
    redirect('unit/kas'); 
  }

  function update_kas_unit_by_id($id_kas){
        if($query = $this->Kas_model->get_jenis_kas()) {
      $data['daftarkas'] = $query;
    }
    else {
      $data['daftarkas'] = NULL;
    }
    $query = $this->Kas_model->laporan_kas_all_by_id($this->session->userdata('id_user'),$id_kas);
    $data['allkas'] = $query;
    $this->load->view('unit/buku_kas_update',$data);
  }

  function update(){
    //$this->Kas_model->set_s();
    $idunit;
      if($query = $this->Kas_model->get_unit_id($this->session->userdata('id_user'))) {
      foreach ($query as $row) {
        $idunit =  $row->id;
      }
    $dataparams = array(
        'id_user' => $this->session->userdata('id_user'),
        'tanggalawal' => $this->input->post('tanggalawal'),
        'tanggalakhir' => $this->input->post('tanggalakhir'),
        'jenis_kas' => $this->input->post('idjeniskas'),
        'unit' => $idunit,
        'tahunpelajaran' => $this->input->post('tahunajaran'), 
        );

    if($query = $this->Kas_model->laporan_kas($dataparams)) {
      $data['kasnya'] = $query;
    }
    else {
      $data['kasnya'] = NULL;
    }    
      $this->load->view('unit/laporan_kas',$data);
  }
}

  function daftar_kas_con(){
    if($query = $this->Kas_model->get_jenis_kas()) {
      $data['daftarkas'] = $query;
    }
    else {
      $data['daftarkas'] = NULL;
    }
    if($query = $this->Kas_model->get_all_unit()) {
      $data['units'] = $query;
    }
    else {
      $data['units'] = NULL;
    }
    if($query = $this->Kas_model->get_tahun_ajaran()) {
      $data['tahuns'] = $query;
    }
    else {
      $data['tahuns'] = NULL;
    }
    $this->load->view('unit/daftar_kas',$data);
  }

  function add(){
    if($query = $this->Kas_model->get_jenis_kas()) {
      $data['daftarkas'] = $query;
    }
    else {
      $data['daftarkas'] = NULL;
    }
       $this->load->view('kas/buku_kas',$data);
  }
  function add_proc(){
    $this->load->model('unit/Kas_model');
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
    if ($this->form_validation->run() == FALSE) {
      $this->add();
    }
    else {
      $tgl_input = date("Y-m-d");
      $idunit;
      if($query = $this->Kas_model->get_unit_id($this->session->userdata('id_user'))) {
      foreach ($query as $row) {
        $idunit =  $row->id;
      }
      }
      //echo "ID USERRRRRRRRRRRRRRRRRR". $tgl_input;
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
        'idunit' => $idunit,
        );
      
      $this->Kas_model->add_data($data);
      redirect('unit/kas');
    }
  }

    function update_proc($id_kas){
    $this->load->model('unit/Kas_model');
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
    if ($this->form_validation->run() == FALSE) {
      $this->add();
    }
    else {
      $tgl_input = date("Y-m-d");
      $idunit;
      if($query = $this->Kas_model->get_unit_id($this->session->userdata('id_user'))) {
      foreach ($query as $row) {
        $idunit =  $row->id;
      }
      }
      //echo "ID USERRRRRRRRRRRRRRRRRR". $tgl_input;
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
        'idunit' => $idunit,
        );
      
      $this->Kas_model->update_data($data,$id_kas);
      redirect('unit/kas');
    }
  }
}

//end off class
//controller/kas/Kas.php