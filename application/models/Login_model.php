<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Login_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	function login($username,$password){
		$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->limit(1);
		$query = $this->db->get('user');
		return $query->num_rows();
	}
	function get_user($username,$password) {
		$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->limit(1);
		$query = $this->db->get('user');	
		return $query->result();
	}
}