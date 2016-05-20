<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('admin/template');
	}

	public function index()
	{	//$data['tes']=Modules::run('admin/proses_home/stef');
		$data['stuff']=Modules::run('admin/proses_home/widget_stuff');
		$data['activity_published']=Modules::run('admin/proses_home/widget_activity_published');
		$data['activity_komentar']=Modules::run('admin/proses_home/widget_activity_komentar');
		$data['quick_draft']=Modules::run('admin/proses_home/widget_quickdraft');
		$data['count']=Modules::run('admin/proses_home/count_fasilitas');
		$this->template->display('template/home',$data);
	}

	public function post($kolom='id_post',$order='desc',$offset=0)
	{
		if ($this->input->get('action')=='edit' && ctype_digit($this->input->get('post'))) {
			$data['post']=Modules::run('admin/proses_post/edit_get_detail',$this->input->get('post'));
			$this->template->display('template/post-edit',$data);
		}else{
			$new_order = ($order=='asc') ? 'desc' : 'asc' ;
			$data['table']=Modules::run('admin/proses_post/post_table',$kolom,$new_order,$offset,$order);
			$data['jason']=Modules::run('admin/proses_post/post_quick_bulk_edit');
			$this->template->display('template/post',$data);			
		}

	}

	public function kategori()
	{
		$this->template->display('template/kategori');
	}

	public function komentar()
	{
		$this->template->display('template/komentar');
	}

	public function post_new()
	{
		$data['kategori_list']=Modules::run('admin/proses_post/get_kategori_list');
		$this->template->display('template/post-new',$data);
	}

	public function page_new()
	{
		$this->template->display('template/pages-new');
	}

	public function page()
	{
		$this->template->display('template/pages');
	}


		public function setting_akun()
	{
		$this->template->display('template/setting-akun');
	}

		public function setting_umum()
	{
		$this->template->display('template/setting-umum');
	}

		public function tags()
	{
		$this->template->display('template/tags');
	}

		public function upload()
	{
		if (ctype_digit($this->input->get('item'))){
			
		}else{
			$data['media_list']=Modules::run('admin/proses_uploads/get_gallery');
			$this->template->display('template/upload',$data);
		}

	}

}

/* End of file Template.php */
/* Location: ./application/controllers/Template.php */