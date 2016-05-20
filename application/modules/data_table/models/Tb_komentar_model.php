<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_komentar_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "tb_komentar";
		return $table;
	}

	function get_all_count() {
		$table = $this->get_table();
		$query=$this->db->count_all_results($table);
		return $query;
	}

	function get_order($order,$sorting){
		$table = $this->get_table();
		$this->db->order_by($order, $sorting);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where($arr) {
		$table = $this->get_table();
		$this->db->where($arr);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where_order($arr,$order,$sorting) {
		$table = $this->get_table();
		$this->db->where($arr);
		$this->db->order_by($order, $sorting);
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

	function _update($id, $data) {
		$table = $this->get_table();
		$this->db->where('id_komentar', $id);
		$this->db->update($table, $data);
	}

	function _custom_query($mysql_query) {
		$query = $this->db->query($mysql_query);
		return $query;
	}

	function _custom_query_num($mysql_query) {
		$query = $this->db->query($mysql_query,$val);
		$num=$query->num_rows();
		return $num;
	}



	function join_komentar_pending_num(){
		$this->db->distinct();
		$this->db->from('tb_komentar','tb_post');
		$this->db->join('tb_post', 'tb_komentar.id_post=tb_post.id_post');
		$this->db->where('tb_komentar.approved_komentar',0);
		$this->db->where('tb_komentar.trash_komentar',0);
		$this->db->where('tb_post.trash_post',0);
		$query = $this->db->get();
		$query=$query->num_rows();
		return $query;
	}

	function join_komentar_post($limit,$offset){
		$this->db->distinct();
		$this->db->from('tb_komentar');
		$this->db->join('tb_post', 'tb_komentar.id_post=tb_post.id_post');
		$this->db->where('tb_komentar.trash_komentar',0);
		$this->db->where('tb_post.trash_post',0);
		$this->db->or_where('tb_komentar.admin_komentar',1);
		$this->db->order_by('tb_komentar.id_komentar', 'desc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query;
	}

	function join_komentar_post_num($limit,$offset){
		$this->db->distinct();
		$this->db->from('tb_komentar');
		$this->db->join('tb_post', 'tb_komentar.id_post=tb_post.id_post');
		$this->db->where('tb_komentar.trash_komentar',0);
		$this->db->where('tb_post.trash_post',0);
		$this->db->or_where('tb_komentar.admin_komentar',1);
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		$query=$query->num_rows();
		return $query;
	}

//example join query
	/*$sql='SELECT DISTINCT tb_komentar.* FROM tb_komentar,tb_post WHERE 
	tb_komentar.id_post=tb_post.id_post AND tb_komentar.trash_komentar=0 AND tb_post.trash_post=0 OR 
	tb_komentar.admin_komentar=1 ORDER BY tb_komentar.id_komentar desc LIMIT '.$limit.' OFFSET '.$offset.' ';*/



}

