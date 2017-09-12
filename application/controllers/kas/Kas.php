<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Kas extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		if(!$this->session->userdata('logged_in') && $this->session->userdata('level') != 1){
			redirect('login', 'refresh');
		}
    $this->load->model('kas/Kas_model');		
	}
  function index(){
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
      $this->load->view('kas/buku_kas',$data);
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
    $jeniskas = $this->Kas_model->get_jenis_kas_byid($this->input->post('idjeniskas'));
    $query = $this->Kas_model->get_unit_byid($this->input->post('unit'));
    $data['jeniskas']=$jeniskas;
    $data['params'] = $dataparams;
    $data['userunits'] = $query;
    if($query = $this->Kas_model->laporan_kas($dataparams)) {
      $data['kasnya'] = $query;
    }
    else {
      $data['kasnya'] = NULL;
    } 
    //$data = []; //disable ori
        //load the view and saved it into $html variable
        $html=$this->load->view('kas/print_kas', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "LAPORAN_BUKU_KAS.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");        
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

    if($query = $this->Kas_model->laporan_kas($dataparams)) {
      $data['kasnya'] = $query;
    }
    else {
      $data['kasnya'] = NULL;
    } 
    //echo 'Tanggal Awal'. $this->input->post('tanggalawal')." <br />"  ;
    //echo 'Tanggal Akhir'. $this->input->post('tanggalakhir')." <br />"  ;
    //echo 'Jenis Kas'. $this->input->post('idjeniskas')." <br />"  ;
    //echo 'Unit'. $this->input->post('unit')." <br />"  ;
    //echo 'Thn Ajr'. $this->input->post('tahunajaran')." <br />"  ;
    $this->load->view('kas/laporan_kas',$data);
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
    $this->load->view('kas/daftar_kas',$data);
  }

  function daftar_kas_print(){
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
    $this->load->view('kas/kas_print',$data);
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
        'idunit' => $this->input->post('unit'),
        );      
      $this->Kas_model->add_data($data);
      redirect('kas/kas');
    }
  }
}

//end off class
//controller/kas/Kas.php