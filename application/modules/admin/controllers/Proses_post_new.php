<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_post_new extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function input_hidden_default(){
		$hidden="<input type='hidden' id='hidden-default' pass='' visibility_default='public' status_default='draft'>";
		return $hidden;
	}

	public function get_kategori(){
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


	public function save_post(){
		$input=$this->input->post(NULL, TRUE);
		$sticky=$input['input_stick'] ? 1 : 0; 
		$komen=$input['allow_komen'] ? 1 : 0;
		$like=$input['allow_like'] ? 1 : 0;  
		$share=$input['allow_share'] ? 1 : 0;

		$id=Modules::run('data_table/tb_post/_insert',
			array('judul_post' => $input['judul_artikel'], 'isi_post' => $input['konten_artikel'], 'waktu_post' => date("Y-m-d H:i:s"),
				'status_post' => $input['submit_form'], 'allow_komen_post' => $komen, 'pass_post' => $input['input_password'],
				'sticky_post' => $sticky, 'sharing_post' => $share, 'like_post' => $like, 'id_kategori' => $input['post_n_kategori'])
		);

		if ($input['input_tag']) {
			$new_tag=$this->get_new_tag($input['input_tag']);
			foreach ($new_tag as $tag) {
					Modules::run('data_table/tb_tag_post/_insert',array('id_post' => $id,'id_tag' => $tag));
				}
		}
		redirect('admin/post?post='.$id.'&action=edit');
	}

	public function get_most_tag(){

	}
}

/* End of file Template.php */
/* Location: ./application/controllers/Template.php */