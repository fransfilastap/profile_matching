<?php

class kriteria extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if( check_adm_login() == FALSE ){		
			redirect('login');
		}

		$this->load->library('breadcrumb');
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>"#","label"=>"Kriteria Penilaian") );		
		$this->breadcrumb->add( array("link"=>site_url('kriteria'),"label"=>"Kriteria") );
	}

	public function index(){

		$this->load->library('parser');

			
		$this->breadcrumb->add( array("link"=>'#',"label"=>"List") );	

		$sql 				=	"SELECT a.id_kriteria,
										a.kode_kriteria,
										a.nama_kriteria,
										a.keterangan
								FROM kriteria a ORDER BY a.kode_kriteria ASC";

		$data['kriterias']	=	$this->db->query( $sql )->result();
		$data['output'] 	= 	$this->load->view("adm/kriteria/list",$data,true);
		$data['skript']		=	$this->parser->parse('scripts/script_criteria.js',array(),true);
		$data['breadcrumb'] = $this->breadcrumb->render();

		$this->load->view('layout',$data);

	}

	public function lihat( $kode ){

		$this->breadcrumb->add( array("link"=>'#',"label"=>"Lihat") );

		$data['kriteria'] 		= $this->db->query("select * from kriteria where kode_kriteria = '$kode' limit 1")->row();
		$data['subkriterias']	= $this->db->query("SELECT * FROM subkriteria where id_kriteria = ".$data['kriteria']->id_kriteria."")->result_array();
		$data['output'] 		= $this->load->view('adm/kriteria/view',$data,true);
		$data['skript']			= $this->load->view('scripts/script_criteria.js',array(),true);
		$data['breadcrumb']     = $this->breadcrumb->render();
		$this->load->view('layout',$data);		
	}

	public function tambah(){
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Tambah") );
		$data['output'] 	= 	$this->load->view("adm/kriteria/add",array(),true);
		$data['breadcrumb'] = $this->breadcrumb->render();
		$this->load->view('layout',$data);
	}

	public function simpan(){
		
		$this->load->library("form_validation");

		$redirect_link = 'kriteria';

		$config = array(
               array(
                     'field'   => 'kode_kriteria', 
                     'label'   => 'Kode Kriteria', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'nama_kriteria', 
                     'label'   => 'nama_kriteria', 
                     'rules'   => 'required'
                  ),
		);


		$this->form_validation->set_rules( $config );

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());
			redirect( $redirect_link );
		}else{

			$kode_kriteria = $this->input->post('kode_kriteria',true);
			$nama_kriteria = $this->input->post('nama_kriteria',true);
			$keterangan    = $this->input->post('keterangan',true);
		
			$kriteria = array(
				'kode_kriteria' => $kode_kriteria,
				'nama_kriteria' => $nama_kriteria,
				'keterangan'	=> $keterangan
			);

			if( $sub ){
				$parent_kriteria = $this->input->post("parent_kriteria",true);
				$kriteria['parent_kriteria'] = $parent_kriteria;
			}

			if( $this->db->insert("kriteria",$kriteria) ){
				$messages = "Kriteria berhasil disimpan.";
				$this->session->set_flashdata('success',$messages);
				redirect( $redirect_link );				
			}else{
				$messages = "Kriteria gagal disimpan.";
				$this->session->set_flashdata('error',$messages);
				redirect( $redirect_link );	
			}

		}		
	}

	public function edit( $kode ){
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Edit") );
		$sql 				= "SELECT * FROM kriteria where kode_kriteria = '$kode' or id_kriteria = '$kode' limit 1";
		$data['kriteria']   = 	$this->db->query( $sql )->row();
		$data['output'] 	= 	$this->load->view("adm/kriteria/add",$data,true);
		$data['breadcrumb'] = $this->breadcrumb->render();
		$this->load->view('layout',$data);
	}

	public function update(){

		$this->load->library("form_validation");

		$config = array(
               array(
                     'field'   => 'nama_kriteria', 
                     'label'   => 'nama_kriteria', 
                     'rules'   => 'required'
                  ),
		);

		$kode_kriteria = $this->input->post('k_krit',true);
		$nama_kriteria = $this->input->post('nama_kriteria',true);
		$keterangan    = $this->input->post('keterangan',true);

		$this->form_validation->set_rules( $config );

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());
			redirect('administrasi/edit_kriteria/'.$kode_kriteria);
		}else{
		
			$kriteria = [
				'nama_kriteria' => $nama_kriteria,
				'keterangan'	=> $keterangan
			];

			$this->db->where('id_kriteria',$kode_kriteria);

			if( $this->db->update("kriteria",$kriteria) ){
				$messages = "Kriteria berhasil diubah.";
				$this->session->set_flashdata('success',$messages);
				redirect('administrasi/edit_kriteria/'.$kode_kriteria);				
			}else{
				$messages = "Kriteria gagal diubah.";
				$this->session->set_flashdata('error',$messages);
				redirect('administrasi/edit_kriteria/'.$kode_kriteria);	
			}

		}		

	}

	public function hapus( $kode ){

		$this->db->where('kode_kriteria', $kode);
		$this->db->or_where('id_kriteria',$kode);
		 
		return ( $this->db->delete('kriteria') );

	}



}