<?php
defined('BASEPATH') OR exit('No direct script allowed');

class User extends CI_Controller{

  public function __Construct(){
    parent:: __construct();
    if(!$this->session->userdata('logged_in')) {

        redirect('login', 'refresh');
      }
      elseif($this->session->userdata('level') != "1") {

      redirect('login', 'refresh');
      }
      $this->load->model('user/User_model');
  }

  function index(){
    if($query = $this->User_model->get_all_user()) {
      $data['usernya'] = $query;
    }
    else
      $data['usernya'] = NULL;
      $this->load->view('user/daftar_user',$data);
  }
  function add(){
    if($query = $this->User_model->get_user_level()) {
      $data['levels'] = $query;
    }
    else {
      $data['levels'] = NULL;
    }
    if($query = $this->User_model->get_user_cabang()) {
      $data['cabangs'] = $query;
    }
    else {
      $data['cabangs'] = NULL;
    }
    if($query = $this->User_model->get_user_unit()) {
      $data['units'] = $query;
    }
    else {
      $data['units'] = NULL;
    }
      $this->load->view('user/tambah_user',$data);
  }
  function update($id_user){
    if($query = $this->User_model->get_user_level()) {
      $data['levels'] = $query;
    }
    else {
      $data['levels'] = NULL;
    }
    if($query = $this->User_model->get_user_cabang()) {
      $data['cabangs'] = $query;
    }
    else {
      $data['cabangs'] = NULL;
    }
    if($query = $this->User_model->get_user_unit()) {
      $data['units'] = $query;
    }
    else {
      $data['units'] = NULL;
    }
    if($query = $this->User_model->get_user_by_id($id_user)) {
      $data['users'] = $query;
    }
    else {
      $data['users'] = NULL;
    }
      $this->load->view('user/update_user',$data);
  }

  function add_proc(){
    $this->load->library('form_validation');
    $this->form_validation->set_message('required', '%s Harus Diisi.');
    $this->form_validation->set_message('matches', 'Password dan Konfirmasi Password harus sama.');
    $this->form_validation->set_message('is_unique', 'Username sudah ada.');

    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('username','Username', 'required|is_unique[user.username]');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');
    $this->form_validation->set_rules('level', 'Level', 'required');
    $this->form_validation->set_rules('cabang', 'Cabang', 'required');
    $this->form_validation->set_rules('unit', 'Unit', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->add();
    }
    else {
      $tgl = date("Y-m-d");
      $data = array(
        'nama_user' => $this->input->post('nama'),
        'username' => $this->input->post('username'),
        'password' => md5($this->input->post('password')),
        'level' => $this->input->post('level'),
        'idcabang' => $this->input->post('cabang'),
        'idunit' => $this->input->post('unit'),        
        );
      
      $this->User_model->add($data);
      redirect('user/user');
    }
  }

  function update_proc($iduser){
    $this->load->library('form_validation');
    $this->form_validation->set_message('required', '%s Harus Diisi.');
    $this->form_validation->set_message('matches', 'Password dan Konfirmasi Password harus sama.');
    //$this->form_validation->set_message('is_unique', 'Username sudah ada.');

    $this->form_validation->set_rules('nama', 'Nama', 'required');
    //$this->form_validation->set_rules('username','Username', 'required|is_unique[user.username]');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');
    $this->form_validation->set_rules('level', 'Level', 'required');
    $this->form_validation->set_rules('cabang', 'Cabang', 'required');
    $this->form_validation->set_rules('unit', 'Unit', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->add();
    }
    else {
      $tgl = date("Y-m-d");
      $data = array(
        'nama_user' => $this->input->post('nama'),
        'username' => $this->input->post('username'),
        'password' => md5($this->input->post('password')),
        'level' => $this->input->post('level'),
        'idcabang' => $this->input->post('cabang'),
        'idunit' => $this->input->post('unit'),        
        );
      echo "id user diupdate".$iduser;
      $this->User_model->update($iduser,$data);
      redirect('user/user');
    }
  }
}

//end of user
//location controller/user