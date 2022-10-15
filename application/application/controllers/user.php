<?php

class user extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if( check_adm_login() == FALSE ){		
			redirect("login");
		}



		$this->load->model('ModelPegawai');

		$this->load->library('breadcrumb');
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>"#","label"=>"User") );	

		if( role('Pegawai') ){
			$this->id = $this->ModelPegawai->getDataPegawai( $this->session->userdata( md5('username') ) )->id;

			$this->db->where("id_pegawai",$this->id);
			$this->db->where("read",0);
			$this->db->from("notifikasi");
			$this->unread_count = $this->db->count_all_results();
		}				
	}

	public function index(){
		$data['output'] = $this->load->view('beranda_user',null,true);
		$data['breadcrumb'] = $this->breadcrumb->render();
		$this->load->view("layout",$data);		
	}

	public function biodata(){
		$this->breadcrumb->add( array("link"=>"#","label"=>"Biodata") );
		$pegawai 	 	 = $this->ModelPegawai->getDataPegawai( $this->session->userdata( md5('username') ) );
		$pendidikans 	 = $this->ModelPegawai->getPendidikanPegawai( $pegawai->id );
		$output		 	 = $this->load->view('adm/pegawai/edit',compact('pegawai','pendidikans'),true);
		$total_pendidikan = count( $pendidikans );
		$skript		 	 = $this->load->view('scripts/script_pegawai_edit.js',compact('total_pendidikan'),true);
		$breadcrumb 	= $this->breadcrumb->render();

		$this->load->view('layout',compact('output','skript','breadcrumb'));
	}

	public function ubah_password(){
		$this->breadcrumb->add( array("link"=>"#","label"=>"Ubah Password") );
		$pengguna 	 	 = $this->db->where('id_user',$this->session->userdata(md5('user_id')))->get('users')->row();
		$output		 	 = $this->load->view('adm/ubah_password',compact('pengguna'),true);

		$breadcrumb 	 = $this->breadcrumb->render();
		$skript 		 = $this->load->view("scripts/script_change_password.js",null,true);

		$this->load->view('layout',compact('output','breadcrumb','skript'));
	}

	public function do_change_password(){
		$this->load->library('form_validation');

		$rules = array(
			
			array(
				'field' => 'password_baru',
				'label' => 'password baru',
				'rules' => 'required|xss_clean'
			),	
			array(
				'field' => 'password_lama',
				'label' => 'password lama',
				'rules' => 'required|xss_clean'
			),				
			array(
				'field' => 'id_user',
				'label' => 'id_user',
				'rules' => 'required|xss_clean'
			)		
		);

		$this->form_validation->set_rules( $rules );

		$notification = array();

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());			
		}else{

			$password_lama	=  trim($this->input->post('password_lama',true)) != "" ? md5( $this->input->post('password_lama',true) ) : "";
			$password_baru  =  trim($this->input->post('password_baru',true)) != "" ? md5( $this->input->post('password_baru',true) ) : "";
			$id_user	= $this->input->post('id_user',true);

			if( $password_lama == $this->session->userdata( md5('password') ) ){

				$this->db->where('id_user',$id_user);
				if( $this->db->update("users", ['password'=>$password_baru] ) ){
					$notification['status'] = "success";
					$notification['message'] = "password berhasil diupdate.";

					$this->session->sess_destroy();

				}else{
					$notification['status'] = "error";
					$notification['message'] = "password gagal diupdate.";
				}

			}else{
				$notification['status'] = "error";
				$notification['message'] = "password lama anda salah!";
			}

		}

		echo json_encode($notification);
	}

	public function pengumuman(){

		$this->db->where("id_pegawai",$this->id);
		$this->db->where("read",0);
		$this->db->update("notifikasi",["read"=>1]);

		$pengumuman  = $this->db->query("SELECT * FROM notifikasi WHERE MONTH(waktu) = MONTH(NOW()) AND id_pegawai = $this->id order by id_notifikasi desc")->result();

		$output = $this->load->view("adm/pengumuman",compact('pengumuman'),true);

		$this->breadcrumb->add( array("link"=>"#","label"=>"Pengumuman") );
		$breadcrumb = $this->breadcrumb->render();		

		$this->load->view('layout',compact('output','breadcrumb','skript'));	

	}



}