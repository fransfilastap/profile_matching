<?php


class pengguna extends CI_Controller{


	public function __construct(){

		parent::__construct();
		if( check_adm_login() == FALSE ){		
			redirect('login');
		}
		if( !role('Manager') ){
				redirect("administrasi/index");
		}
		$this->load->library('breadcrumb');
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>site_url('pengguna'),"label"=>"Users") );
	}

	public function index(){
		$this->db->order_by('id_user');

		$this->breadcrumb->add( array("link"=>'#',"label"=>"List") );

		$users				=  $this->db->get('users')->result();
		$output			 	=  $this->load->view('adm/pengguna/list',compact('users'),true);
		
		$styles			 	= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$scripts		 	= array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );
		$skript			 	= $this->load->view('scripts/script_pengguna.js',null,true);
		$breadcrumb 		= $this->breadcrumb->render();

		$this->load->view('layout', compact('output','scripts','skript','breadcrumb') );
	}

	public function tambah(){
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Tambah") );
		$output			 	= $this->load->view("adm/pengguna/add",null,true);
		$styles				= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$scripts		 	= array( 
								base_url('assets/bootstrap/js/bootstrap-fileupload.js'),
								base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.js'), 
								base_url('assets/bootstrap-daterangepicker/date.js'),
								base_url('assets/bootstrap-daterangepicker/daterangepicker.js'),
								base_url('assets/bootstrap-timepicker/js/bootstrap-timepicker.js')
				  			  );
		//$skript			 	= $this->load->view('scripts/script_penggu_add.js',null,true);
		$breadcrumb = $this->breadcrumb->render();
		$this->load->view('layout',compact('output','styles','skript','breadcrumb'));
	}

	public function simpan(){


		$this->load->library('form_validation');

		$rules = array(

			array(
				'field' => 'nama_pengguna',
				'label' => 'nama',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'username',
				'label' => 'username',
				'rules' => 'required|xss_clean'
			),			
			array(
				'field' => 'password',
				'label' => 'password',
				'rules' => 'xss_clean'
			),
			array(
				'field' => 'role',
				'label' => 'role',
				'rules' => 'required|xss_clean'
			),			
		);

		$redirect_link  = site_url('pengguna/tambah');

		$this->form_validation->set_rules( $rules );

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());
			redirect( $redirect_link );			
		}else{

			$nama 		= $this->input->post('nama_pengguna',true);
			$username 	= $this->input->post('username',true);
			$password   = trim($this->input->post('password',true)) != "" ? md5( $this->input->post('password',true) ) : "";
			$role    	= $this->input->post('role',true);
			
			if( $this->db->insert("users", compact('nama','username','password','role') ) ){
				$messages = "Pengguna berhasil disimpan.";
				$this->session->set_flashdata('success',$messages);
				redirect( $redirect_link );				
			}else{
				$messages = "Pengguna gagal disimpan.";
				$this->session->set_flashdata('error',$messages);
				redirect( $redirect_link );	
			}
		}

	}

	public function edit($kode){

		$this->breadcrumb->add( array("link"=>'#',"label"=>"Edit") );
		$pengguna 	 	 = $this->db->where('id_user',$kode)->get('users')->row();
		$output		 	 = $this->load->view('adm/pengguna/edit',compact('pengguna'),true);
		$breadcrumb 		= $this->breadcrumb->render();
		$this->load->view('layout',compact('output','breadcrumb'));
	}

	public function ganti_password($kode){
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Ganti Password") );
		$pengguna 	 	 = $this->db->where('id_user',$kode)->get('users')->row();
		$output		 	 = $this->load->view('adm/pengguna/change_password',compact('pengguna'),true);
		$breadcrumb 	 = $this->breadcrumb->render();
		$this->load->view('layout',compact('output','breadcrumb'));
	}

	public function do_change_password(){
		$this->load->library('form_validation');

		$rules = array(
			
			array(
				'field' => 'password',
				'label' => 'password',
				'rules' => 'required|xss_clean'
			),	
			array(
				'field' => 'id_user',
				'label' => 'id_user',
				'rules' => 'required|xss_clean'
			)		
		);

		$redirect_link  = site_url('pengguna/ganti_password');

		$this->form_validation->set_rules( $rules );

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());			
		}else{

			$password	=  trim($this->input->post('password',true)) != "" ? md5( $this->input->post('password',true) ) : "";
			$id_user	= $this->input->post('id_user',true);

			$this->db->where('id_user',$id_user);
			if( $this->db->update("users", compact('password') ) ){
				$messages = "password berhasil diupdate.";
				$this->session->set_flashdata('success',$messages);			
			}else{
				$messages = "password gagal diupdate.";
				$this->session->set_flashdata('error',$messages);
			}
		}

		redirect( $redirect_link."/".$this->input->post('id_user') );			
	}


	public function update(){

		$this->load->library('form_validation');

		$rules = array(

			array(
				'field' => 'nama_pengguna',
				'label' => 'nama',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'username',
				'label' => 'username',
				'rules' => 'required|xss_clean'
			),			
			array(
				'field' => 'role',
				'label' => 'role',
				'rules' => 'required|xss_clean'
			),	
			array(
				'field' => 'id_user',
				'label' => 'id_user',
				'rules' => 'required|xss_clean'
			)		
		);

		$redirect_link  = site_url('pengguna/tambah');

		$this->form_validation->set_rules( $rules );

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());
			redirect( $redirect_link );			
		}else{

			$nama 		= $this->input->post('nama_pengguna',true);
			$username 	= $this->input->post('username',true);
			$role    	= $this->input->post('role',true);
			$id_user	= $this->input->post('id_user',true);

			$this->db->where('id_user',$id_user);
			if( $this->db->update("users", compact('nama','username','password','role') ) ){
				$messages = "Pengguna berhasil diupdate.";
				$this->session->set_flashdata('success',$messages);
				redirect( $redirect_link );				
			}else{
				$messages = "Pengguna gagal diupdate.";
				$this->session->set_flashdata('error',$messages);
				redirect( $redirect_link );	
			}
		}
	}

	public function hapus($kode){

		$this->db->where('id_user',$kode);
		return $this->db->delete('users');

	}

}