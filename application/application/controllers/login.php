<?php

class login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if( check_adm_login() ){
			redirect("administrasi/index");
		}
	}

	public function index(){

		$this->load->view("login");
	}

	public function masuk(){
		$this->load->library('form_validation');
		$config = array(
               array(
                     'field'   => 'username', 
                     'label'   => 'username', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required'
                  ),
		);

		$this->form_validation->set_rules($config);

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());
			redirect( site_url('login') );
		}
		else{
			$username 	= $this->input->post("username",true);
			$password 	= md5( $this->input->post("password",true) );

			$result = $this->db->query("SELECT * FROM users where username = '$username' and password = '$password' LIMIT 1");

			if( $result->num_rows() <= 0 ){
				$this->session->set_flashdata('error','Maaf username dan password anda salah');
				redirect( 'login' );
			}else{
				
				$user = $result->row();
				$this->session->set_userdata( md5('username'),$username);
				$this->session->set_userdata( md5('password'),$password);
				$this->session->set_userdata( md5('nama'),$user->nama );
				$this->session->set_userdata( md5('user_id'),$user->id_user);


				if( $user->role != "Pegawai" ){
					redirect( site_url('administrasi/index') );
				}else{
					redirect( site_url('user') );
				}
			}
		}

	}


}