<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_post extends MX_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('pagination','table'));
		$this->load->helper(array('pagination_modifikasi','tanggal'));
	}

	private $limit=2;
	public function post_table($order_colomn,$order_type,$offset,$old_order)
		{

			$all_post=Modules::run('data_table/tb_post/get_paged_list',$this->limit,$offset,$order_colomn,$order_type)->result();
			$kategoris=Modules::run('data_table/tb_kategori/_get')->result();

			$data['pagination']=$this->post_pagination_table($order_colomn,$old_order);
			$data['head_table']=$this->post_head_table($order_type,$offset,$order_colomn);
			foreach ($kategoris as $kategori) {
				$data['kategori_list'][]="<input type='radio' name='kategori_post' value=".$kategori->id_kategori."> <span>".$kategori->nama_kategori."</span><br>";
			} 

			foreach ($all_post as $post) {
				$data['tr_table'][]=$this->post_data_table($post);
			}
			return $data;
		}


	public function post_get_tag($id_post,$jenis){
			$all_tag=Modules::run('data_table/tb_post/get_tags_num',array('tb_post.trash_post' => 0,'tb_post.id_post' => $id_post));
			if ($all_tag>0) {
				$all_tag=Modules::run('data_table/tb_post/get_tags',array('tb_post.trash_post' => 0,'tb_post.id_post' => $id_post))->result();
				
				if ($jenis=='post') {
					foreach ($all_tag as $key) {$link_tag[]="<a href=".$key->nama_tag.">".$key->nama_tag."</a>";}
					$tags=implode(",", $link_tag);
				}
				else if($jenis=='edit_post'){
					foreach ($all_tag as $key) {$link_tag[]="<span><a href='javascript:void(0);' class='fa fa-times-circle-o clstag post-n-clstag' ></a><span> ".$key->nama_tag."</span>&nbsp;&nbsp;&nbsp;<input type='hidden' name='input_tag[]' value=".$key->nama_tag." /></span>";}
					$tags=implode("", $link_tag);
				}
								
			}else{$tags="";} //ambil tags
			
			return $tags;	
	}

	public function post_data_table($post){

			$post->pass_post ? $status_post[]='Password Protected' : null;

			if ($post->status_post=='publish') {
				$status='Published';
			}else{
				$status="Perubahan Terakhir"; 
				$status_post[]=$post->status_post;
			}

			$post->sticky_post==1 ? $status_post[]='Sticky' : null;

			if (isset($status_post)) {
				$glue=implode(", ",$status_post);
				$stat_post="- ".$glue; 
			}else{$stat_post="";}

			$tags=$this->post_get_tag($post->id_post,'post');
			$komentar_num=Modules::run('data_table/tb_komentar/get_where_num',array('trash_komentar' => 0,'id_post' => $post->id_post));
			if ($komentar_num>0) {$komentar="<span class='badge badge-ada'>".$komentar_num."</span>";}
			else{$komentar="<span class='badge badge-none'>".$komentar_num."</span>";}
	
			$isi_post=strlen($post->isi_post)>400 ? substr($post->isi_post, 0,400)."..." : $post->isi_post; 
			$judul_post=trim($post->judul_post)==!'' ? $post->judul_post : '(no title)';   

			$kategori=Modules::run('data_table/tb_post/get_kategori',array('id_post' => $post->id_post ))->row_array();
			$data_table="<tr class='data-edit' id=".$post->id_post."  sticky=".$post->sticky_post." komen=".$post->allow_komen_post." pass='".$post->pass_post."' status=".$post->status_post." >
	 				<td class='tablecheck'> <input type='checkbox' name='check-post'> </td>
	 				<td class='judul-post'><a href='' class='judul_post'>".$judul_post." <b>".$stat_post."</b></a><br><br>
	 					<div class='isi_post_quick'>".$isi_post."</div>
						<p class='hideaksi'><a href=".base_url('admin/post?post='.$post->id_post.'&action=edit')." >Edit</a> | <a href='javascript:void(0);' class='quick-edit-a'>Quick Edit</a> | <a href='javascript:void(0);' class='trash_post_a'>Trash</a> | <a href=''>Preview</a> </p>									</td>
	 				<td class='kategori_post' id-kategori=".$kategori['id_kategori'].">".$kategori['nama_kategori']."</td>
	 				<td class='tag_post'>".$tags."</td>
	 				<td class='komentar_post'><a href=''>".$komentar."</a></td>
	 				<td class='detail_post'>".tgl_native($post->waktu_post)."<br>".$status."</td>
	 			</tr>";

	 		return $data_table;
	}


	public function post_head_table($order,$offset,$kolom){
			$head_table='<tr>
							<input type="hidden" class="arrow-kondisi" order="'.$order.'" kolom="'.$kolom.'">
							<th><input type="checkbox" name="check-all"></th>
							<th>'.anchor('admin/post/judul_post/'.$order.'/'.$offset, 'Judul',array('class' => 'judul-link' )).'&nbsp&nbsp<i class="fa fa-unsorted   judul-arrow" > </i></th>
							<th>Kategori</th>
							<th>Tags</th>
							<th><i class="fa fa-comment"></i></th>
							<th>'.anchor('admin/post/waktu_post/'.$order.'/'.$offset, 'Tanggal', array('class' => 'waktu-link' )).'&nbsp&nbsp<i class="fa fa-unsorted   waktu-arrow" > </i></th>
						</tr>';
			return $head_table;
	}


	public function post_pagination_table($order_colomn,$order_type){
	 		$base_url='admin/post';
	 		$total_rows=Modules::run('data_table/tb_post/get_where_num',array('trash_post' => 0));
			$uri_segment=5;
			$config['base_url']=base_url().'admin/post/'.$order_colomn.'/'.$order_type;
			$config['total_rows'] =$total_rows;
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = $uri_segment;
			$config['full_tag_open'] = "<ul class='pagination pull-right'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$this->pagination->initialize($config);
			$paging= $this->pagination->create_links();
			return $paging;
	}


	public function post_quick_bulk_edit(){
		if (isset($_POST['ajax'])) {
			if ((int)$_POST['ajax']==4) {
			 	$update=json_decode($_POST['quick_data']);
			 	$id=$update->id_post;
			 	$post=Modules::run('data_table/tb_post/get_where',array('id_post' => $id ))->row_array();
			 	$judul=$update->judul_post;
			 	$status=$update->status_post;
			 	if ($status!='publish') { //ambil waktu update jika status bukan publish
			 		$waktu= date("Y-m-d H:i:s");
			 	}
			 	else{
			 		$waktu=$post['waktu_post'];
			 	}
			 	$komen=$update->komen_post;
			 	$kategori=$update->kategori_post;

			 	$data=array('judul_post' => $judul,'status_post' => $status,'allow_komen_post' => $komen,'id_kategori' => $kategori,'pass_post' => $update->pass_post,'sticky_post' => $update->sticky_post);
			 	Modules::run('data_table/tb_post/_update',$id,$data);
			 	$new_tag=$this->get_new_tag($update->tags_post);
			 	Modules::run('data_table/tb_tag_post/_delete',$id); // hapus semua tag yang berkaitan dengan post saat ini
			 	foreach ($new_tag as $tag) { //insert daftar tag baru pada tabel tb_tag_post
			 		Modules::run('data_table/tb_tag_post/_insert',array('id_post' => $id,'id_tag' => $tag));
			 	}
			 	$post=Modules::run('data_table/tb_post/get_where',array('id_post' => $id))->result();
			 	foreach ($post as $posts ) {
			 		$new_row=$this->post_data_table($posts);
			 	}
			 	echo $new_row;
			}
			else if ((int)$_POST['ajax']==5) {
				$update=json_decode($_POST['bulk_data']);
				$data=[];
				if ($update->id_post) {
					foreach ($update->id_post as $id) {
						if ($update->kategori_post) {
							$data+= array('id_kategori'=> $update->kategori_post);
						}
						if(!is_null($update->komen_post)){
							$data+= array('allow_komen_post'=> $update->komen_post);
						}
						if(!is_null($update->sticky_post)){
							$data+= array('sticky_post'=> $update->sticky_post);
						}
						if ($update->status_post) {
							$data+= array('status_post'=> $update->status_post);
						}
						if (count($update->tags_post)>0) {
							$new_tag=$this->get_new_tag($update->tags_post);
							foreach ($new_tag as $tag) {
			 					Modules::run('data_table/tb_tag_post/_insert',array('id_post' => $id,'id_tag' => $tag));
			 				}
						}
						if (count($data)>0) {
							Modules::run('data_table/tb_post/_update',$id,$data);
						}
						
					}
				}
			}
		 } 
		else{
			echo json_encode($hai="tidak");
		}

	}

	public function get_new_tag($tags){
		 	$all_tags=Modules::run('data_table/tb_tags/_get')->result();
		 	foreach ($all_tags as $tag) { //ambil semua tag yang ada
					$data_tag[$tag->id_tag]=trim(strtolower($tag->nama_tag));
				}
		 	foreach ($tags as $tag) { //cocokan tag yang di update dengan tag yang ada agar tidak terjadi duplikasi tag
		 		$index=array_search(trim(strtolower($tag)), $data_tag);
		 		if ($index) { //jika tag update di temukan di daftar tag
		 			$new_tag[]=$index;
		 		}
		 		else{
		 			$index=Modules::run('data_table/tb_tags/_insert',array('nama_tag' => strtolower($tag)));
		 			$new_tag[]=$index;
		 		}
		 	}

		 	return $new_tag;	
	}

	public function ke_trash(){
		if (isset($_POST['ajax'])) {
			if ((int)$_POST['ajax']==6||(int)$_POST['ajax']==7) {
				$data_id=json_decode($_POST['trash_data']);
				if (count($data_id)>1) { //jika menghapus menggunakan bulk edit
					foreach ($data_id as $id) {
						$data[]=array('id_post' => $id, 'trash_post' => 1);
					}
					Modules::run('data_table/tb_post/_update_batch','id_post',$data);
					$id_trash=implode('_',$data_id);					
				}
				else{
					$id_trash=$data_id[0];
					Modules::run('data_table/tb_post/_update',$id_trash,array('trash_post' => 1));
				}

				$trash = array('post_trash' => $id_trash, 'jmlh_trash' => count($data_id));
				$this->session->set_flashdata($trash);
			}
		}
		if (isset($_GET['undo_trash'])) {
			$data_id=explode('_', $_GET['undo_trash']);
			foreach ($data_id as $id) {
				$data[]=array('id_post' => $id, 'trash_post' => 0);
			}
			Modules::run('data_table/tb_post/_update_batch','id_post',$data);
			$this->session->set_flashdata('trash_undo',count($data_id));
			redirect('admin/post','refresh');
		}
	}

////////////////////////////////////////post-new dan post-edit//////////////////////////////////////////

	public function edit_get_detail($id){ //post-edit fungsi
		$post=Modules::run('data_table/tb_post/get_where',array('id_post' => $id))->row_array();
		$post['like_post_btn']=(int)$post['like_post']==1 ? 'checked' : '';
		$post['sharing_post_btn']=(int)$post['sharing_post']==1 ? 'checked' : '';
		$post['komen_post_btn']= (int)$post['allow_komen_post']==1 ? 'checked' : '';

		$all_tag=Modules::run('data_table/tb_post/get_tags',
				array('tb_post.id_post' => $post['id_post']))->result();
		$post['tags']=$this->post_get_tag($post['id_post'],'edit_post');

		$kategoris=Modules::run('data_table/tb_kategori/_get')->result();
		$kategori_check=Modules::run('data_table/tb_kategori/get_where',array('id_kategori' => $post['id_kategori'] ))->row_array();
		foreach ($kategoris as $kategori) {
			$check=$kategori->id_kategori==$kategori_check['id_kategori'] ? 'checked' : '';
			$kat[]="<p><input type='radio' name='post_n_kategori' value=".$kategori->id_kategori." ".$check."> <span>".$kategori->nama_kategori."</span></p>";
		} 

		$visibility=($post['pass_post']) ? 'password' : (($post['sticky_post']) ? 'public_sticky' : 'public');
		$post['kategori_list']=$kat;
		$post['hidden_default']="<input type='hidden' id='hidden-default'  name='id_post' value=".$post['id_post']." visibility-default=".$visibility." status-default=".$post['status_post']." pass=".$post['pass_post'].">";
		return $post;
	}


	public function get_kategori_list(){ //post-new fungsi
		if (isset($_POST['ajax'])) {
			if ((int)$_POST['ajax']==8) {
				$kategori=$_POST['kategori'];
				$id=Modules::run('data_table/tb_kategori/_insert',array('nama_kategori' => $kategori));
				echo "<p><input type='radio' name='post_n_kategori' value=".$id." > <span>".$kategori."</span></p>";
			}
		}else{
			$kategoris=Modules::run('data_table/tb_kategori/_get')->result();
			foreach ($kategoris as $kategori) {
				if ($kategori->nama_kategori=='uncategorized') {$check='checked';}else{$check='';}
				$data[]="<p><input type='radio' name='post_n_kategori' value=".$kategori->id_kategori." ".$check."> <span>".$kategori->nama_kategori."</span></p>";
			} 
			return $data;			
		}

	}

	public function save_post(){
		// $ini[]='judul='.$this->input->post('judul_artikel');
		// $ini[]='isi='.$this->input->post('konten_artikel');
		// $ini[]='komen='.$this->input->post('allow_komen');
		// $ini[]='like='.$this->input->post('allow_like');
		// $ini[]='sharing='.$this->input->post('allow_share');
		// $ini[]='judul='.$this->input->post('judul_artikel');
		// $ini[]='tags='.implode(',',$this->input->post('input_tag'));
		// $ini[]='sticky='.$this->input->post('input_stick');
		// $ini[]='password='.$this->input->post('input_password');
		// $ini[]='kategori='.$this->input->post('post_n_kategori');
		// $ini[]='status='.$this->input->post('ppublished');
		// $data=implode('<br>',$ini);
		// $id=$this->input->post('id_post');
		// $this->session->set_flashdata('form',$data);


		$sticky=$this->input->post('input_stick') ? 1 : 0; 
		$komen=$this->input->post('allow_komen') ? 1 : 0;
		$like=$this->input->post('allow_like') ? 1 : 0;  
		$share=$this->input->post('allow_share') ? 1 : 0;
		
		if ($this->input->post('submit_form')=='publish'||$this->input->post('submit_form')=='pending'||$this->input->post('submit_form')=='draft') {

			$id=Modules::run('data_table/tb_post/_insert',
				array('judul_post' => $this->input->post('judul_artikel'), 'isi_post' => $this->input->post('konten_artikel'), 'waktu_post' => date("Y-m-d H:i:s"),
					'status_post' => $this->input->post('ppublished'), 'allow_komen_post' => $komen, 'pass_post' => $this->input->post('input_password'),
					'sticky_post' => $sticky, 'sharing_post' => $share, 'like_post' => $like, 'id_kategori' => $this->input->post('post_n_kategori'))
			);

			if (count($this->input->post('input_tag'))>0) {
				$new_tag=$this->get_new_tag($this->input->post('input_tag'));
				foreach ($new_tag as $tag) {
						Modules::run('data_table/tb_tag_post/_insert',array('id_post' => $id,'id_tag' => $tag));
					}
			}

			redirect('admin/post?post='.$id.'&action=edit');
		}
		else if($this->input->post('submit_form')=='update'){

			$id=$this->input->post('id_post');
			$post=Modules::run('data_table/tb_post/get_where',array('id_post' => $id ))->row_array();
		 	$waktu= ($this->input->post('ppublished')!='publish') ? date("Y-m-d H:i:s") : $post['waktu_post'];
		
		 	Modules::run('data_table/tb_post/_update',$id,				
		 					array('judul_post' => $this->input->post('judul_artikel'), 'isi_post' => $this->input->post('konten_artikel'), 'waktu_post' => $waktu,
					'status_post' => $this->input->post('ppublished'), 'allow_komen_post' => $komen, 'pass_post' => $this->input->post('input_password'),
					'sticky_post' => $sticky, 'sharing_post' => $share, 'like_post' => $like, 'id_kategori' => $this->input->post('post_n_kategori'))
		 		);

			Modules::run('data_table/tb_tag_post/_delete',$id); // hapus semua tag yang berkaitan dengan post saat ini
			if (count($this->input->post('input_tag'))>0) {
				$new_tag=$this->get_new_tag($this->input->post('input_tag'));
				foreach ($new_tag as $tag) {
						Modules::run('data_table/tb_tag_post/_insert',array('id_post' => $id,'id_tag' => $tag));
					}
			}

			redirect('admin/post?post='.$id.'&action=edit','refresh');

		}


	}


}

/* End of file Template.php */
/* Location: ./application/controllers/Template.php */