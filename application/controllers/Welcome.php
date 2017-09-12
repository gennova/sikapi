<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent:: __construct();
		if(!$this->session->userdata('logged_in') && $this->session->userdata('level')!=1) {

	    	redirect('login', 'refresh');
	   	}
   		elseif($this->session->userdata('level') != "1") {

   		redirect('login', 'refresh');
	   	}
	}
	public function index()
	{	
		$this->load->model('kas/Kas_model');
		$query = $this->Kas_model->laporan_kas_all();
		$data['allkas'] = $query;
		$this->load->view('welcome_message',$data);
	}
}
