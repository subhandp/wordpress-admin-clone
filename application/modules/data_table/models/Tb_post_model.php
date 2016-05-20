<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_post_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "tb_post";
		return $table;
	}

	function get_all_count() {
		$table = $this->get_table();
		$query=$this->db->count_all_results($table);
		return $query;
	}

	function get_where($arr) {
		$table = $this->get_table();
		$this->db->where($arr);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where_order($arr,$order_by,$sorting) {
		$table = $this->get_table();
		$this->db->where($arr);
		$this->db->order_by($order_by,$sorting);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where_num($arr) {
		$table = $this->get_table();
		$this->db->where($arr);
		$query=$this->db->get($table);
		$num=$query->num_rows();
		return $num;
	}

	function _insert($data) {
		$table = $this->get_table();
		$this->db->insert($table, $data);
		$id=$this->db->insert_id();
		return $id;
	}

	function get_paged_list($limit,$offset,$order_column,$order_type)
	{
		$table = $this->get_table();
		$this->db->where('trash_post',0);
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($table,$limit,$offset);
	}

	function get_kategori($kolom){
		$this->db->select('tb_post.id_post, tb_post.id_kategori,tb_kategori.nama_kategori');
		$this->db->from('tb_post');
		$this->db->join('tb_kategori',' tb_post.id_kategori=tb_kategori.id_kategori');
		$this->db->where($kolom);
		$query = $this->db->get();
		return $query;		
	}

	function get_tags($kolom){
		$this->db->select('tb_tag_post.id_tag,tb_tags.nama_tag');
		$this->db->from('tb_tag_post');
		$this->db->join('tb_tags','tb_tag_post.id_tag=tb_tags.id_tag');
		$this->db->join('tb_post','tb_tag_post.id_post=tb_post.id_post');
		$this->db->where($kolom);
		$query = $this->db->get();
		return $query;
	}

	function get_tags_num($kolom){
		$this->db->from('tb_tag_post');
		$this->db->join('tb_tags','tb_tag_post.id_tag=tb_tags.id_tag');
		$this->db->join('tb_post','tb_tag_post.id_post=tb_post.id_post');
		$this->db->where($kolom);
		$query = $this->db->get();
		$query=$query->num_rows();
		return $query;
	}

	function _update($id, $data) {
		$table = $this->get_table();
		$this->db->where('id_post', $id);
		$this->db->update($table, $data);
	}

	function _update_batch($where,$data){
		$table = $this->get_table();
		$this->db->update_batch($table, $data, $where); 
	}
}

