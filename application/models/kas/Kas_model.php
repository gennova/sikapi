<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Kas_model extends CI_Model{
	function __Construct(){
		parent::__Construct();
	}

	function add_data($data){
		$this->db->insert('kas',$data);
		return;
	}

	function get_user_unit($iduser){
		$this->db->where('user.id_user',$iduser);
		$this->db->join('unit','user.idunit=unit.id');
		$this->db->select("*");
		$query = $this->db->get('user');
		return $query->result();
	}

	function get_all_unit(){
		$this->db->select("*");
		$query = $this->db->get('unit');
		return $query->result();
	}

	function get_unit_byid($id_unit){
		$this->db->where('id',$id_unit);
		$this->db->select("*");
		$query = $this->db->get('unit');
		return $query->result();
	}

	function get_jenis_kas(){
		$this->db->select('*');
		$query = $this->db->get('jenis_kas');
		return $query->result();
	}

	function get_jenis_kas_byid($idjenis){
		$this->db->where('id',$idjenis);
		$this->db->select('*');
		$query = $this->db->get('jenis_kas');
		return $query->result();
	}

	function get_tahun_ajaran(){
		$this->db->select('distinct(tahunpelajaran) as tahunpelajaran');
		$query = $this->db->get('kas');
		return $query->result();
	}

	function set_s(){
		$this->db->select('@s:=0');
		$query = $this->db->get('kas');
		return $query->result();
	}

	function laporan_kas($data){		
		$query = $this->db->query('select @s:=0;');	
		$query = $this->db->query("SELECT *, @k:=IF(transaksi='kredit',nominal,0) AS Kredit,@d:=IF(transaksi='debet',nominal,0) AS Debet , @s:=@s+@d-@k AS Saldo FROM kas join user on kas.id_user = user.id_user where kas.tanggal between '".$data['tanggalawal']."' and '".$data['tanggalakhir']."' and kas.jenis_kas=".$data['jenis_kas']." and kas.tahunpelajaran='".$data['tahunpelajaran']."' and kas.idunit = ".$data['unit']."");
		return $query->result();
	}

	function laporan_kas_all(){		
		$query = $this->db->query('select @s:=0;');	
		$query = $this->db->query("SELECT *, @k:=IF(transaksi='kredit',nominal,0) AS Kredit,@d:=IF(transaksi='debet',nominal,0) AS Debet , @s:=@s+@d-@k AS Saldo FROM kas join user on kas.id_user = user.id_user join unit on user.idunit=unit.id");
		return $query->result();
	}

	function delete_kas($id_kas){
		$this->db->where("id_kas",$id_kas);
		$this->db->delete("kas");
		return;
	}
}

//end off class
//models/kas/Kas_model.php