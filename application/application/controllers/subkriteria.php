<?php

class subkriteria extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if( check_adm_login() == FALSE ){		
			redirect('login');
		}

		$this->load->library('breadcrumb');
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>"#","label"=>"Kriteria Penilaian") );		
		$this->breadcrumb->add( array("link"=>site_url('subkriteria'),"label"=>"Subkriteria") );

	}

	public function index(){
		$this->load->library('parser');

		$this->breadcrumb->add( array("link"=>'#',"label"=>"List") );

		$sql = "SELECT a.id_subkriteria,
					   a.kode_subkriteria,
					   a.nama_subkriteria,
					   a.keterangan,
					   (case a.jenis_nilai when 'CF' then 'Core Factor' when 'SF' then 'Secondary Factor' else 'Belum Ditentukan' end ) as jenis_nilai,
					   b.nama_kriteria
				FROM subkriteria a
				LEFT JOIN kriteria b 
					ON a.id_kriteria = b.id_kriteria 
				ORDER BY a.id_subkriteria ASC";

		$data['subkriterias']	=	$this->db->query( $sql )->result();
		$data['output'] 		= 	$this->load->view("adm/subkriteria/list",$data,true);
		$data['styles'] 	= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$data['scripts'] 	= array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
								);
		$data['skript']			=	$this->parser->parse('scripts/script_subcriteria.js',array(),true);
		$data['breadcrumb']		=	$this->breadcrumb->render();

		$this->load->view('layout',$data);
	}

	public function tambah(){
		$this->breadcrumb->add( array("link"=>"#","label"=>"Tambah") );
		$data['kriterias']  = $this->db->query("select  * from kriteria")->result();
		$data['output'] 	= 	$this->load->view("adm/subkriteria/add",$data,true);
		$data['breadcrumb'] = $this->breadcrumb->render();
		$this->load->view('layout',$data);
	}

	public function simpan(){

		$this->load->library("form_validation");

		$redirect_link = 'subkriteria/tambah';

		$config = array(
               array(
                     'field'   => 'nama_kriteria', 
                     'label'   => 'nama_kriteria', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'jenis_nilai', 
                     'label'   => 'jenis_nilai', 
                     'rules'   => 'required'
                  ),
               
               array(
					'field' => 	'parent_kriteria',
					'label'	=>	'Parent Kriteria',
					'rules'	=>	'required'
				)
		);

		$this->form_validation->set_rules( $config );

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());
			redirect( $redirect_link );
		}else{

			$kode_kriteria = $this->input->post('kode_kriteria',true);
			$nama_kriteria = $this->input->post('nama_kriteria',true);
			$jenis_nilai   = $this->input->post('jenis_nilai',true);
			$keterangan    = $this->input->post('keterangan',true);
		
			$kriteria = [
				'kode_subkriteria' => $kode_kriteria,
				'nama_subkriteria' => $nama_kriteria,
				'jenis_nilai' => $jenis_nilai,
				'keterangan'	=> $keterangan
			];
			
			$parent_kriteria = $this->input->post("parent_kriteria",true);
			$kriteria['id_kriteria'] = $parent_kriteria;
			
			if( $this->db->insert("subkriteria",$kriteria) ){
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
		$this->breadcrumb->add( array("link"=>"#","label"=>"Edit") );
		$sql 				= 	"SELECT * FROM subkriteria where kode_subkriteria = '$kode' or id_subkriteria = '$kode' limit 1";
		$data['subkriteria']   = 	$this->db->query( $sql )->row();
		$data['kriterias']  = $this->db->query("select  * from kriteria")->result();
		$data['output'] 	= 	$this->load->view("adm/subkriteria/add",$data,true);
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
               array(
                     'field'   => 'jenis_nilai', 
                     'label'   => 'jenis_nilai', 
                     'rules'   => 'required'
                  ),               
		);

		$kode_kriteria = $this->input->post('k_krit',true);
		$nama_kriteria = $this->input->post('nama_kriteria',true);
		$jenis_nilai   = $this->input->post('jenis_nilai',true);
		$keterangan    = $this->input->post('keterangan',true);
		$parent_kriteria = $this->input->post("parent_kriteria",true);

		$this->form_validation->set_rules( $config );

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('error',validation_errors());
			redirect('subkriteria/edit/'.$kode_kriteria);
		}else{
		
			$kriteria = [
				'nama_subkriteria' => $nama_kriteria,
				'jenis_nilai' => $jenis_nilai,
				'id_kriteria' 	=> $parent_kriteria,
				'keterangan'	=> $keterangan,
			];

			$this->db->where('id_subkriteria',$kode_kriteria);

			if( $this->db->update("subkriteria",$kriteria) ){
				$messages = "Sub-Kriteria berhasil diubah.";
				$this->session->set_flashdata('success',$messages);
				redirect('subkriteria/edit/'.$kode_kriteria);				
			}else{
				$messages = "Kriteria gagal diubah.";
				$this->session->set_flashdata('error',$messages);
				redirect('subkriteria/edit/'.$kode_kriteria);	
			}

		}

	}

	public function hapus( $kode ){

		$this->db->where('kode_subkriteria', $kode);
		$this->db->or_where('id_subkriteria',$kode);
		 
		return ( $this->db->delete('subkriteria') );
	}


}