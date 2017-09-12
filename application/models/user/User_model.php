<?php
defined('BASEPATH') OR exit('No direct script allowed');

class User_model extends CI_Model{
	function __Construct(){
		parent::__Construct();
	}

	function get_all_user(){
		$this->db->select('*');
		$this->db->join('unit','user.idunit=unit.id');
		$this->db->join('cabang','user.idcabang=cabang.id');
		$query =  $this->db->get('user');
		return $query->result();
	}
	function get_user_by_id($id_user){
		$this->db->select('*');
		$this->db->join('unit','user.idunit=unit.id');
		$this->db->join('cabang','user.idcabang=cabang.id');
		$this->db->where('user.id_user='.$id_user);
		$this->db->limit(1);
		$query =  $this->db->get('user');
		return $query->result();
	}
	function get_user_level(){
		$this->db->select('*');
		$query =  $this->db->get('level');
		return $query->result();
	}
	function get_user_cabang(){
		$this->db->select('*');
		$query =  $this->db->get('cabang');
		return $query->result();
	}
	function get_user_unit(){
		$this->db->select('*');
		$query =  $this->db->get('unit');
		return $query->result();
	}
	function add($data) {
		$this->db->insert('user',$data);
		return;
	}

	function update($id,$data) {
		$this->db->where('id_user',$id);
		$this->db->update('user',$data);
		return;
	}

	function hapus($id) {
		$this->db->where('id_user',$id);
		$this->db->delete('user');
		return;
	}
}