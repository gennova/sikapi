<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	public function index(){
		$this->load->view('login.php');
	}

	public function auth() {
		$this->load->model('Login_model');
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', '%s Harus Diisi.');
		$this->form_validation->set_rules('form-username', 'Username', 'required');
		$this->form_validation->set_rules('form-password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login');
		}
		else {
			$username = $this->input->post('form-username');
			$password = $this->input->post('form-password');
			$status = $this->Login_model->login($username,md5($password));
			echo 'status = '.$status;
			if($status > 0) {
	 	  		$sessiondata = $this->session->userdata('id_user');
				if($query = $this->Login_model->get_user($username,md5($password))) {
				foreach($query as $user) : {
				$sessiondata = array(
					'id_user' => $user->id_user,
					'nama_user' => $user->nama_user,
					'username' => $user->username,
					'id_unit' => $user->idunit,
					'id_cabang' => $user->idcabang,
					'level' => $user->level,
					'logged_in'  => TRUE,
					);				
				$this->session->set_userdata($sessiondata);	
				} endforeach; 
				}
				else {
				$data['usernya'] = NULL;			
						
				}
				if($this->session->userdata('level')==1){
					redirect('welcome');					
				}else if ($this->session->userdata('level')==4){
					echo $this->session->userdata('level');
					redirect('unit/kas');
				}
						
			}
			else {
				echo 'gagal login';
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Username atau Password Anda Salah!</div>');
                redirect('login');
			}
			

	}
}
}