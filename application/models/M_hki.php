<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hki extends CI_Model {

	function get_data($where,$table){		
	return $this->db->get_where($table,$where);
	}
	function get_data_all($table){
		return $this->db->get($table);
	}
	
	public function get_hki_keyword($keyword){
			$this->db->select('*');
			$this->db->from('hki');
			$this->db->like('no_pencatatan',$keyword);
			$this->db->or_like('nama',$keyword);
			$this->db->or_like('judul',$keyword);
			$this->db->or_like('no_pemohon',$keyword);
			$this->db->or_like('tgl_permohonan',$keyword);
			return $this->db->get()->result();
	}
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	function delete_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}
}

/* End of file m_hki.php */
/* Location: ./application/models/m_hki.php */