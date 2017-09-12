<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	 public function __construct() {

	 	parent::__construct();
	 	if(!$this->session->userdata('logged_in')) {

	    	redirect('login', 'refresh');
	   	}
	 }

	 function index() {
	 	
	 	$this->session->unset_userdata('logged_in');
	   	session_destroy();
	   	redirect('login', 'refresh');
	}
}