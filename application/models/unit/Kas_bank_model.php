<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Kas_bank_model extends CI_Model{
	function __Construct(){
		parent::__Construct();
		$this->load->model('unit/Kas_bank_model');
	}

	function add_data($data){
		$this->db->insert('kas_bank',$data);
		return;
	}

	function update_data($data,$id_kas){
		$this->db->where('id_kas',$id_kas);
		$this->db->update('kas_bank',$data);
		return;
	}

	function get_all_unit(){
		$this->db->select("*");
		$query = $this->db->get('unit');
		return $query->result();
	}

	function get_unit_by_id($id_unit){
		$this->db->where('id',$id_unit);
		$this->db->select("*");
		$query = $this->db->get('unit');
		return $query->result();
	}

	function get_bank_kas_id_kas($id_kas_bank){
		$this->db->limit(1);
		$this->db->where('id_kas',$id_kas_bank);
		$this->db->select("*");
		$query = $this->db->get('kas_bank');
		return $query->result();
	}

	function get_user_unit($id_user){
		$this->db->where('user.id_user',$id_user);
		$this->db->select("*");
		$this->db->join('unit','user.idunit=unit.id');
		$query = $this->db->get('user');
		return $query->result();
	}

	function get_jenis_kas(){
		$this->db->select('*');
		$query = $this->db->get('jenis_kas');
		return $query->result();
	}

	function get_jenis_kas_byid($idkas){
		$this->db->where('id',$idkas);
		$this->db->select('*');
		$query = $this->db->get('jenis_kas');
		return $query->result();
	}

	function get_tahun_ajaran(){
		$this->db->select('distinct(tahunpelajaran) as tahunpelajaran');
		$query = $this->db->get('kas_bank');
		return $query->result();
	}

	function set_s(){
		$this->db->select('@s:=0');
		$query = $this->db->get('kas_bank');
		return $query->result();
	}

	function laporan_kas($data){		
		$query = $this->db->query('select @s:=0;');	
		$query = $this->db->query("SELECT *, @k:=IF(transaksi='kredit',nominal,0) AS Kredit,@d:=IF(transaksi='debet',nominal,0) AS Debet , @s:=@s+@d-@k AS Saldo FROM kas_bank join user on kas_bank.id_user = user.id_user where kas_bank.tanggal between '".$data['tanggalawal']."' and '".$data['tanggalakhir']."' and kas_bank.jenis_kas=".$data['jenis_kas']." and kas_bank.idunit=".$data['unit']." and kas_bank.tahunpelajaran='".$data['tahunpelajaran']."'");
		return $query->result();
	}

	function laporan_kas_all_by_id($id_user,$id_kas){		
		$query = $this->db->query('select @s:=0;');	
		$query = $this->db->query("SELECT *, @k:=IF(transaksi='kredit',nominal,0) AS Kredit,@d:=IF(transaksi='debet',nominal,0) AS Debet , @s:=@s+@d-@k AS Saldo FROM kas_bank where id_user=".$id_user." and id_kas=".$id_kas."");
		return $query->result();
	}

	function delete_kas($id_kas){
		$this->db->where("id_kas",$id_kas);
		$this->db->delete("kas_bank");
		return;
	}
}

//end off class
//models/kas/Kas_bank_model.php