<?php 

class administrasi extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if( check_adm_login() == FALSE ){		
			redirect('login');
		}
		
		$this->load->library('breadcrumb');
		$this->breadcrumb = new Breadcrumb();		

	}

	public function index(){
		$data['output'] = $this->load->view('adm/beranda',null,true);
		$data['breadcrumb'] = $this->breadcrumb->render();
		$this->load->view("layout",$data);
	}

	public function keluar(){
		$this->session->sess_destroy();
		redirect( site_url( 'login' ) );
	}

}