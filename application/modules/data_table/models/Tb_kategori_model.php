<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_kategori_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "tb_kategori";
		return $table;
	}

	function _get() {
		$table = $this->get_table();
		$query=$this->db->get($table);
		return $query;
	}

	function get_post_kategori($id_post){
		$this->db->select('tb_kategori.nama_kategori,tb_kategori.id_kategori');
		$this->db->from('tb_post_kategori');
		$this->db->join('tb_kategori','tb_post_kategori.id_kategori=tb_kategori.id_kategori');
		$this->db->where('tb_post_kategori.id_post', $id_post);
		$query = $this->db->get();
		return $query;
	}


	function _insert($data) {
		$table = $this->get_table();
		$this->db->insert($table, $data);
		$id=$this->db->insert_id();
		return $id;
	}

	function get_where($arr) {
		$table = $this->get_table();
		$this->db->where($arr);
		$query=$this->db->get($table);
		return $query;
	}
	
}

