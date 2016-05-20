<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_home extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('table');
		$this->load->helper('admin/tanggal');
		
	}

	function stef(){
			$judul='judul';
			$isi='isi';
			$waktu= date("Y-m-d H:i:s");  
			$id=Modules::run('data_table/tb_post/_insert',array('judul_post' => $judul, 'isi_post' => $isi, 'status_post' => 'draft', 'waktu_post' => $waktu));
			return $id;
	}

	function widget_quickdraft(){
		if (isset($_POST['ajax_draft'])) {
			$judul=$_POST['judul'];
			$isi=$_POST['isi'];
			$waktu= date("Y-m-d H:i:s");  
			Modules::run('data_table/tb_post/_insert',array('judul_post' => $judul, 'isi_post' => $isi, 'status_post' => 'draft', 'waktu_post' => $waktu));
			if (strlen($isi)>200) {
				$isi_post=substr($isi,0,200)."...";
			}
			$data['drafts']="<p>".anchor('judulpost', ''.$judul.'').
				" <span class='tgl'>".tgl_indo($waktu,false)."</span> <br> 
				<span class='isi-draft'>".$isi."</span></p>";

			echo json_encode($data);
		}
		else{
			$query=Modules::run('data_table/tb_post/get_where',array('status_post' => 'draft'))->result();
			if ($query) {
				foreach ($query as $draft) {

					if (strlen($draft->isi_post)>200) {
						$isi_post=substr($draft->isi_post,0,200)."...";
					}
					else{
						$isi_post=$draft->isi_post;
					}

					$data['list_draft'][]="<p>".anchor('judulpost', ''.$draft->judul_post.'').
					" <span class='tgl'>".tgl_indo($draft->waktu_post,false)."</span> <br> 
					<span class='isi-draft'>".$isi_post."</span></p>";
				}
			}
		}

		return $data;
	}

	function count_fasilitas(){
		$data['post']=Modules::run('data_table/tb_post/get_where_num',array('trash_post' => 0));
		$data['komentar']=Modules::run('data_table/tb_komentar/get_where_num',array('trash_komentar' => 0));
		$data['uploads']=Modules::run('data_table/tb_uploads/get_all_count');
		return $data;
	}

	function widget_activity_komentar(){
		$limit=4;
		if (isset($_POST['offset'])) {
			$offset=$_POST['offset'];
			$n_offset=$offset*$limit;
			$komen=Modules::run('data_table/tb_komentar/join_komentar_post',$limit,$n_offset)->result();
			$data['more']=$this->activity_template_more($offset,$limit);

			foreach ($komen as $komentar) {
				$arr = array('id_post' => $komentar->id_post);
				$post=Modules::run('data_table/tb_post/get_where',$arr)->row_array();
				$return=$this->activity_template_komentar($komentar,$post);
				$data['komen'][]=$return['komen'];
			}

			echo json_encode($data);
		}
		else{
			$komen_row=Modules::run('data_table/tb_komentar/join_komentar_post_num',$limit,$offset);
	
			if ($komen_row>0) {
				$offset=0;
				$komen=Modules::run('data_table/tb_komentar/join_komentar_post',$limit,$offset)->result();				
				$data['more']=$this->activity_template_more($offset,$limit);

				foreach ($komen as $komentar) {
					$arr = array('id_post' => $komentar->id_post);
					$post=Modules::run('data_table/tb_post/get_where',$arr)->row_array();
					$return=$this->activity_template_komentar($komentar,$post);
					$data['komen'][]=$return['komen'];
				}

			$data['komen_num'][]=Modules::run('data_table/tb_komentar/join_komentar_pending_num');
			$data['komen_num'][]=Modules::run('data_table/tb_komentar/get_where_num',array('approved_komentar' => 1 ));
			$data['komen_num'][]=Modules::run('data_table/tb_komentar/get_where_num',array('trash_komentar' => 1 ));
				

			} else{return false;}

		return $data;

		}
}


	function activity_template_more($offset,$limit){
		$n_offset=($offset+1)*$limit;
		$row=Modules::run('data_table/tb_komentar/join_komentar_post_num',$limit,$n_offset);
		if ($row>0) {
			$offset++;
			return "<button class='btn btn-default btn-block' offset='$offset' data-loading-text='loading...' id='btn-more'>Load More</button>";
		}
		else{
			return false;
		}
	}

	function activity_template_komentar($komentar,$post){ 
		if ($komentar->approved_komentar==0) {											
			$tr="<tr class='homeunapproved'>";			
			$clss="<p class='hideaksi'><a href='javascript:void(0);' class='appm link-app' id=".$komentar->id_komentar.">approve</a> | <a href=''>Reply</a> | <a href=''>Edit</a> | <a href='javascript:void(0);' class='trashm' id=".$komentar->id_komentar.">Trash</a></p>";			
		}			
		else{			
			$tr="<tr>";			
			$clss="<p class='hideaksi'><a href='javascript:void(0);' class='unappm link-app' id=".$komentar->id_komentar.">unapprove</a> | <a href=''>Reply</a> | <a href=''>Edit</a> | <a href='javascript:void(0);' class='trashm' id=".$komentar->id_komentar.">Trash</a></p>";			
		}			

				$data['komen']="".$tr."<td>						
						<div class='media komenshow'>						
							<img src=".$komentar->foto_komentar." alt='' class='pptabledash pull-left'>						
							<div class='media-body'>						
								<h5 class='media-heading'><span class='tgl '>Dari</span> <a href=''>".$komentar->nama_komentar."</a> <span class='tgl'>pada</span> <a href=''>".$post['judul_post']."</a> <a href=''>#</a></h5>						
								<span>".$komentar->isi_komentar."</span>						
								".$clss."						
							</div>						
						</div>
						<div class='media komentrash' >                     
                             <img src=".$komentar->foto_komentar." alt='' class='ppkomentrash pull-left'>                       
                             <div class='media-body'>                        
                                    <p class='media-heading'>komentar dari <strong>".$komentar->nama_komentar."</strong> di pindah ke trash. <a href='javascript:void(0);' class='undo-komen' id=".$komentar->id_komentar.">undo</a></p>                                            
                             </div>                      
                        </div> 						
					</td>						
				</tr>";		

		return $data;
	}

	function activity_template_update_komentar(){
		if (isset($_POST['ajax'])) {
			if ($_POST['jenis']=='approved') {
				$id=$_POST['id_komen'];
				Modules::run('data_table/tb_komentar/_update',$id,array('approved_komentar' => 1));
			}
			else if ($_POST['jenis']=='unapproved'){ 
				$id=$_POST['id_komen'];
				Modules::run('data_table/tb_komentar/_update',$id,array('approved_komentar' => 0));
			}
			else if ($_POST['jenis']=='trash'){
				$id=$_POST['id_komen'];
				Modules::run('data_table/tb_komentar/_update',$id,array('trash_komentar' => 1));
			}
			else if ($_POST['jenis']=='undo-trash'){
				$id=$_POST['id_komen'];
				Modules::run('data_table/tb_komentar/_update',$id,array('trash_komentar' => 0));
			}

			$data['komen_num'][]=Modules::run('data_table/tb_komentar/join_komentar_pending_num');
			$data['komen_num'][]=Modules::run('data_table/tb_komentar/get_where_num',array('approved_komentar' => 1 ));
			$data['komen_num'][]=Modules::run('data_table/tb_komentar/get_where_num',array('trash_komentar' => 1 ));
			echo json_encode($data);
		}
	}

	function widget_activity_published(){
		$sorting='desc'; $order='id_post';
		$isi1='status_post'; $field1='publish'; $isi2='trash_post'; $field2=0;
		$arr= array('status_post' => 'publish','trash_post' => 0);

		$query=Modules::run('data_table/tb_post/get_where_num',$arr);

		if ($query>0) {
			$query=Modules::run('data_table/tb_post/get_where_order',$arr,$order,$sorting)->result();
			foreach ($query as $publish) {
				$tgl[]= "<p>".tgl_indo($publish->waktu_post,3)."</p>";
				$judul[]=anchor('admin/post/edit', '<p>'.$publish->judul_post.'</p>');
			}
			$data['tgl']=$tgl;
			$data['judul']=$judul;
			$published[]=$data;
			return $published;
		}
		else{
			$data='kosong';
		}

	}



	function widget_stuff(){
		$limit=11;
		$sorting='desc';
		$order='id_stuff';
		$total_row=Modules::run('data_table/tb_stuff/get_all_count');
		if ($total_row>$limit) {
			//jika jumlah data tabel tb_stuff lebih besar dari batas yg di tentukan
			$offset=$total_row-$limit;
		}
		else{
			$offset=0;
		}

		if ($total_row>0) {
			$query=Modules::run('data_table/tb_stuff/get',$order,$sorting)->result();
				if ($this->stuff_template_moderasi()){
					$data_stuff[]=$this->stuff_template_moderasi();
				}

				foreach ($query as $stuff) {
					if ($stuff->jenis_stuff=='post') {
						if ($this->stuff_template_post($stuff->id_jenis_stuff)) {
							$data_stuff[]=$this->stuff_template_post($stuff->id_jenis_stuff);
						}
					}
					else if ($stuff->jenis_stuff=='update') {
						if ($this->stuff_template_update($stuff->id_jenis_stuff)) {
							$data_stuff[]=$this->stuff_template_update($stuff->id_jenis_stuff);
						}
					}
					else if ($stuff->jenis_stuff=='komen') {
						if ($this->stuff_template_komentar($stuff->id_jenis_stuff)) {
							$data_stuff[]=$this->stuff_template_komentar($stuff->id_jenis_stuff);
						}
					}

					if (count($data_stuff)>15){ 
						//berhenti jika array $data_stuff sudah berisi lebih dari angka yg si tentukan
						break;
					}
				}

				return $data_stuff;
			
				/*for($i=0;$i<count($data_stuff);$i++){
					$this->table->add_row($data_stuff[$i]);
				}

				$template = array(
		        	'table_open' => '<table class="table">'
				);
				$this->table->set_template($template);

				$table=$this->table->generate();
				return $table;		*/
		}
		else{
			$data_stuff[]='kosong';
			return $data_stuff;
		}


	}



	function stuff_template_post($id){
		$arr = array('id_post' => $id);
		$post=Modules::run('data_table/tb_post/get_where_order',$arr)->row_array();
		if ($post['status_post']=='draft'||$post['status_post']=='pending'||$post['trash_post']==1) {
			//kriteria post yang tidak di tampilkan pada stuff
			return false;
		}
		else{
			$post_siap='New Post: '.anchor('users', ''.$post['judul_post'].'').' ('.anchor('proses/proses_post/edit_post/edit='.$post['id_post'], 'edit').')';
			return $post_siap;				
		}

	}

	function stuff_template_update($id){
		$arr = array('id_post' => $id);
		$update=Modules::run('data_table/tb_post/get_where_order',$arr)->row_array();
		if ($update['status_post']=='draft'||$update['status_post']=='pending'||$update['trash_post']==1) {
			return false;
		}
		else{
			$update_siap='Updated: '.anchor('users', ''.$update['judul_post'].'').' ('.anchor('proses/proses_post/edit_post/edit='.$update['id_post'], 'edit').')';
			return $update_siap;
		}
	}

	function stuff_template_komentar($id){		
		$arr = array('id_komentar' => $id );
		$komentar=Modules::run('data_table/tb_komentar/get_where',$arr)->row_array();

		//ambil post tempat komentar
		$arr = array('id_post' => $komentar['id_post']);		
		$post=Modules::run('data_table/tb_post/get_where_order',$arr)->row_array();
		
		/*komentar tidak tampil pada stuff : jika komentar tdk di approved,komentar masuk trash,post dari komentar
			masuk trash*/
		if ($komentar['admin_komentar']==1) {
			$komentar_siap='anda berkomentar pada: '.anchor('users', ''.$post['judul_post'].'');
			return $komentar_siap;
		}
		else if ($komentar['approved_komentar']==0||$komentar['trash_komentar']==1||$post['trash_post']==1) {
			return false;
		}
		else{
			$komentar_siap=''.anchor('webpage/urlfacebook', ''.$komentar['nama_komentar'].'').''.' berkomentar pada '.anchor('users', ''.$post['judul_post'].'');
			return $komentar_siap;
		}
	}

	function stuff_template_moderasi(){
		$moderasi=Modules::run('data_table/tb_komentar/join_komentar_pending_num');
		if ($moderasi>0) {
			$moderasi_siap=anchor('admin/komentar/unapproved', ''.$moderasi.' menunggu moderasi');
			return $moderasi_siap;
		}
		else{
			return false;
		}
	}

}

/* End of file Template.php */
/* Location: ./application/controllers/Template.php */