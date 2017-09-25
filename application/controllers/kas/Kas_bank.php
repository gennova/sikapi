<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Kas_bank extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		if(!$this->session->userdata('logged_in')&& $this->session->userdata('level') != 1){
			redirect('login', 'refresh');
		}
    $this->load->model('kas/Kas_bank_model');		
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
      $this->load->view('kas/buku_kas_bank',$data);
  }

  function update(){
    //$this->Kas_model->set_s();
    $dataparams = array(
        'id_user' => $this->session->userdata('id_user'),
        'tanggalawal' => $this->input->post('tanggalawal'),
        'tanggalakhir' => $this->input->post('tanggalakhir'),
        'jenis_kas' => $this->input->post('idjeniskas'),
        'unit' => $this->input->post('unit'),
        'tahunpelajaran' => $this->input->post('tahunajaran'), 
        );
    if($query = $this->Kas_bank_model->get_unit_by_id($this->input->post('unit'))) {
      $data['units'] = $query;
    }
    else {
      $data['units'] = NULL;
    }

    if($query = $this->Kas_bank_model->get_jenis_kas_by_id($this->input->post('idjeniskas'))) {
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
      $this->load->view('kas/laporan_kas_bank',$data);
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
    $this->load->view('kas/daftar_kas_bank',$data);
  }

  function daftar_kas_bank_print(){
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
    $this->load->view('kas/kas_bank_print',$data);
  }

  function printing(){
    $dataparams = array(
        'id_user' => $this->session->userdata('id_user'),
        'tanggalawal' => $this->input->post('tanggalawal'),
        'tanggalakhir' => $this->input->post('tanggalakhir'),
        'jenis_kas' => $this->input->post('idjeniskas'),
        'unit' => $this->input->post('unit'),
        'tahunpelajaran' => $this->input->post('tahunajaran'), 
        );
    $jeniskas = $this->Kas_bank_model->get_jenis_kas_by_id($this->input->post('idjeniskas'));
    $query = $this->Kas_bank_model->get_unit_by_id($this->input->post('unit'));
    $data['jeniskas']=$jeniskas;
    $data['params'] = $dataparams;
    $data['userunits'] = $query;
    if($query = $this->Kas_bank_model->laporan_kas($dataparams)) {
      $data['kasnya'] = $query;
    }
    else {
      $data['kasnya'] = NULL;
    } 
    //$data = []; //disable ori
        //load the view and saved it into $html variable
        $html=$this->load->view('kas/print_kas_bank', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "LAPORAN_BUKU_KAS_BANK.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");        
    }

  function add(){
    if($query = $this->Kas_bank_model->get_jenis_kas()) {
      $data['daftarkas'] = $query;
    }
    else {
      $data['daftarkas'] = NULL;
    }
       $this->load->view('kas_bank/buku_kas_bank',$data);
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
        'idunit'  =>$this->input->post('unit'),  
        );
      
      $this->Kas_bank_model->add_data($data);
      redirect('kas/kas');
    }
  }
}

//end of class
//controller/kas/Kas_bank.php