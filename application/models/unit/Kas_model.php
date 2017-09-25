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
	function update_data($data,$id_kas){
		$this->db->where('id_kas',$id_kas);
		$this->db->update('kas',$data);
		return;
	}

	function get_all_unit(){
		$this->db->select("*");
		$query = $this->db->get('unit');
		return $query->result();
	}

	function get_unit_id($id){
		$this->db->where('user.id_user',$id);
		$this->db->select("*");
		$this->db->join('user','unit.id=user.idunit');
		$query = $this->db->get('unit');
		return $query->result();
	}

	function get_jenis_kas(){
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
	function laporan_kas_all($id_user){		
		$query = $this->db->query('select @s:=0;');	
		$query = $this->db->query("SELECT *, @k:=IF(transaksi='kredit',nominal,0) AS Kredit,@d:=IF(transaksi='debet',nominal,0) AS Debet , @s:=@s+@d-@k AS Saldo FROM kas where id_user=".$id_user."");
		return $query->result();
	}
	function laporan_kas_all_by_id($id_user,$id_kas){		
		$query = $this->db->query('select @s:=0;');	
		$query = $this->db->query("SELECT *, @k:=IF(transaksi='kredit',nominal,0) AS Kredit,@d:=IF(transaksi='debet',nominal,0) AS Debet , @s:=@s+@d-@k AS Saldo FROM kas where id_user=".$id_user." and id_kas=".$id_kas."");
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