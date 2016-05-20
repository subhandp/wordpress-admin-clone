<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_uploads extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		

	}


	public function upload_file(){
		if (!empty($_FILES) && $this->input->is_ajax_request()) {

			$dir_image='assets/media/images/';
			$dir_other='assets/media/dokumen/';
			$tipeMime=$_FILES['media']['type'];
			$tempFile = $_FILES['media']['tmp_name'];
			$fileName = $_FILES['media']['name'];
			$ukuranFile = $_FILES['media']['size'];
			$targetPathImage = getcwd() . '/'.$dir_image;
			$targetPathOther = getcwd() . '/'.$dir_other;
			$tipe=explode("/", $tipeMime);
			$targetFile = $tipe[0]=='image' ? $targetPathImage.$fileName : $targetPathOther.$fileName;
			$lokasi_upload = $tipe[0]=='image' ? $dir_image.$fileName : $dir_other.$fileName;
			$pathinfo=pathinfo($lokasi_upload);
			move_uploaded_file($tempFile, $targetFile);
		}
		$id = Modules::run('data_table/tb_uploads/_insert', array('nama_file_upload_edit' => $pathinfo['filename'],'nama_file_upload' => $fileName, 'ukuran_upload' => $ukuranFile, 'tipe_file_upload' => $pathinfo['extension'], 'lokasi_upload' => $lokasi_upload));
		$image_gallery=$this->get_gallery($id)[0];
		echo $image_gallery;

	}

	public function get_gallery($id_upload=false)
	{
		$image=array('jpg', 'jpeg', 'png', 'gif');
		$kompres = array('zip','rar');
		$other=Array
		(
		    (0) => Array
		        (
		            ('tipe') => 'pdf',
		            ('fa') => 'fa-file-pdf-o',
		        ),
		    (1) => Array
		        (
		            ('tipe') => 'xlsx',
		            ('fa') => 'fa-file-excel-o',
		        ),
		    (2) => Array
		        (
		            ('tipe') => 'xls',
		            ('fa') => 'fa-file-excel-o',
		        ), 
		    (3) => Array
		        (
		            ('tipe') => 'ppt',
		            ('fa') => 'fa-file-powerpoint-o',
		        ),
		    (4) => Array
		        (
		            ('tipe') => 'pptx',
		            ('fa') => 'fa-file-powerpoint-o',
		        ),
		    (5) => Array
		        (
		            ('tipe') => 'doc',
		            ('fa') => 'fa-file-word-o',
		        ),
		    (6) => Array
		        (
		            ('tipe') => 'docx',
		            ('fa') => 'fa-file-word-o',
		        ),
		    (7) => Array
		        (
		            ('tipe') => 'zip',
		            ('fa') => 'fa-file-zip-o',
		        ),
		    (8) => Array
		        (
		            ('tipe') => 'rar',
		            ('fa') => 'fa-file-zip-o',
		        )
		);
		
		$gal = $id_upload ? (Modules::run('data_table/tb_uploads/get_where', array('id_upload' => $id_upload))->result()) : (Modules::run('data_table/tb_uploads/_get','desc')->result()) ;
		$class_media = $id_upload ? ("class='thumbnail media-new'") : ("class='thumbnail'");
		foreach ($gal as $gallery) {
			if (in_array(strtolower($gallery->tipe_file_upload), $image)) {
				$data[]="
					<div class='col-lg-2'>
					<input class='input-hidden' type='hidden' id='".$gallery->id_upload."' waktu='".$gallery->waktu_upload."' tipe='".$gallery->tipe_file_upload."' ukuran='".$gallery->ukuran_upload."' nama='".$gallery->nama_file_upload."'>
						<a ".$class_media." href='javascript:void(0);' value='".$gallery->id_upload."'>
							<img alt='kosong' class='media-img' src= '".base_url($gallery->lokasi_upload)."'>
						</a>
					</div>";
			}else{
				$key = array_search(strtolower($gallery->tipe_file_upload), array_column($other, 'tipe'));
				$data[]="
					<div class='col-lg-2'>
						<input class='input-hidden' type='hidden' id='".$gallery->id_upload."' waktu='".$gallery->waktu_upload."' tipe='".$gallery->tipe_file_upload."' ukuran='".$gallery->ukuran_upload."' nama='".$gallery->nama_file_upload."'>
						<a ".$class_media." href='javascript:void(0);' value='".$gallery->id_upload."'>
						    <i class='".$other[$key]['fa']." fa fa-5x fa-media media-img' ></i>
						    <div class='caption caption-media '>
								<b class='caption-media'>".$gallery->nama_file_upload."</b>
							</div>
						</a>
					</div>";
			}
		}
		return $data;
	}


}

/* End of file Template.php */
/* Location: ./application/controllers/Template.php */