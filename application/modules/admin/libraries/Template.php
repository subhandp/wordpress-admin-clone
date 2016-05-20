<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
	protected $ci;
	private $data;
    private $js_file;
    private $css_file;
    private $jquery_data;
	public function __construct()
	{
        $this->ci =& get_instance();
        $this->addCSS( base_url('assets/css/bootstrap.min.css') );
        $this->addCSS( base_url('assets/css/admin.css') );
        $this->addCSS( base_url('assets/font-awesome/css/font-awesome.min.css') );
        $this->addJS( base_url('assets/js/jquery.js') );
        $this->addJS( base_url('assets/js/jquery-color.js') );
        $this->addJS( base_url('assets/js/bootstrap.min.js') );
	}

    public function assets_home(){
        $this->addCSS( base_url('assets/css/plugins/morris.css') );
        $this->addJS( base_url('assets/js/plugins/flot/jquery.flot.js') );
        $this->addJS( base_url('assets/js/plugins/flot/jquery.flot.tooltip.min.js') );
        $this->addJS( base_url('assets/js/plugins/flot/jquery.flot.resize.js') );
        $this->addJS( base_url('assets/js/plugins/flot/jquery.flot.pie.js') );
        $this->addJS( base_url('assets/js/plugins/flot/flot-data.js') );
        $this->addJQ( base_url('assets/js/jquery/home.js') );

    }


    public function assets_edit_new_post(){
        $this->addJS( base_url('assets/js/ckeditor/ckeditor.js') );
        $this->addJQ( base_url('assets/js/jquery/post-edit.js') );
    }

    public function assets_post(){
        $this->addJQ( base_url('assets/js/jquery/post.js') );
    }

    public function assets_uploads(){
        $this->addJS( base_url('assets/library/dropzone/dropzone.js') );
        $this->addCSS( base_url('assets/library/dropzone/dropzone.css') );
        $this->addJQ( base_url('assets/js/jquery/uploads.js') );
    }

	public function display($template,$data=NUll){
        if ($template=='template/home') {
            $this->assets_home();
            //widget halaman dashboard/home
            $data['widget_activity']=$this->ci->load->view('widget/activity', $data, true);
            $data['widget_stuff']=$this->ci->load->view('widget/stuff', $data, true);
            $data['widget_quickdraft']=$this->ci->load->view('widget/quickdraft', $data, true);
            $data['widget_upload']=$this->ci->load->view('widget/statistik_upload', $data, true);
            $data['widget_utama']=$this->ci->load->view('widget/statistik_utama', $data, true);
            $this->data['title']='dashboard';
        }

        if ($template=='template/setting-akun'){
            $this->data['title']='akun setting';
        }

        if ($template=='template/setting-akun'){
            $this->data['title']='akun setting';
        }

        if ($template=='template/setting-umum'){
            $this->data['title']='umum setting';
        }

        if ($template=='template/tags'){
            $this->data['title']='tags';
        }

        if ($template=='template/upload'){
            $this->assets_uploads();
            $this->data['title']='upload';
        }

        if ($template=='template/kategori'){
            $this->data['title']='kategori';
        }

        if ($template=='template/komentar'){
            $this->data['title']='komentar';
        }

        if ($template=='template/post'){
            $this->assets_post();
            $this->data['title']='semua post';
        }

        if ($template=='template/post-new'){
            $this->assets_edit_new_post();
            $this->data['title']='post baru';
        }

        if ($template=='template/post-edit'){
            $this->assets_edit_new_post();
            $this->data['title']='Edit Post';
        }

        if ($template=='template/pages'){
            $this->data['title']='semua page';
        }

        if ($template=='template/pages-new'){
            $this->assets_new_post();
            $this->data['title']='page baru';
        }


        $this->load_JS_and_css();
		$this->data['konten']=$this->ci->load->view($template, $data,true);
		$this->data['navigasi']=$this->ci->load->view('template/header', $data, true);
		$this->data['sidebar']=$this->ci->load->view('template/sidebar',$data, true);
		$this->ci->load->view('index',$this->data);
	}

    public function addJQ( $name )
    {
        $this->data['jquery_file'] = file_get_contents($name);
    }

	public function addJS( $name )
    {
        $js = new stdClass();
        $js->file = $name;
        $this->js_file[] = $js;
    }

    public function addCSS( $name )
    {
        $css = new stdClass();
        $css->file = $name;
        $this->css_file[] = $css;
    }

    private function load_JS_and_css()
    {
        $this->data['html_head'] = '';

        if ( $this->css_file )
        {
            foreach( $this->css_file as $css )
            {
                $this->data['html_head'] .= "<link rel='stylesheet' type='text/css' href=".$css->file.">". "\n";
            }
        }

        if ( $this->js_file )
        {
            foreach( $this->js_file as $js )
            {
                $this->data['html_head'] .= "<script type='text/javascript' src=".$js->file."></script>". "\n";
            }
        }


    }

	

}

/* End of file Tempalate.php */
/* Location: ./modules/admin/libraries/Tempalate.php */
