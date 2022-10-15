<?php

class profil_mutasi extends CI_Controller{


	public function __construct(){
		parent::__construct();
		if( check_adm_login() == FALSE ){		
			redirect('login');
		}
		

		$this->load->library('breadcrumb');
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Kriteria Penilaian") );
		$this->breadcrumb->add( array("link"=>site_url("profil_mutasi"),"label"=>"Profile Mutasi") );
	}

	public function index(){


		$this->breadcrumb->add( array("link"=>"#","label"=>"List") );		

		$this->load->library('parser');

		$data['profiles']		=	$this->db->get('profil_mutasi')->result();
		$data['output'] 		= 	$this->load->view("adm/profil_mutasi/list",$data,true);
		$data['skript']			=	$this->parser->parse('scripts/script_profil_list.js',array(),true);
		$data['styles'] 	= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$data['scripts'] 	= array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );

		$data['breadcrumb'] = $this->breadcrumb->render();

		$this->load->view('layout',$data);	



	}

	public function tambah(){

		$this->breadcrumb->add( array("link"=>"#","label"=>"Tambah") );

		$this->load->library('parser');
		$this->db->order_by('id_kriteria','desc');
		$kriterias	= $this->db->get('kriteria')->result_array();
		$tables = array();

		array_walk($kriterias, function(&$value,&$key)use(&$tables){
			$this->db->where('id_kriteria',$value['id_kriteria']);
			array_push($tables, $value['kode_kriteria']);
			$value['child'] = $this->db->get('subkriteria')->result_array();
		});

		$data['kriterias'] 		= $kriterias;
		$data['tables']			= json_encode($tables);
		$data['output'] 		= $this->load->view('adm/profil_mutasi/add',$data,true);
		$data['skript'] 		= $this->parser->parse('scripts/script_profil_mutasi.js',array(),true);
		$data['breadcrumb'] = $this->breadcrumb->render();
		
		$this->load->view('layout',$data);

	}

	public function simpan(){

		$this->load->library('form_validation');

		$rules = array(
            array(
            		'field'		=> 'nama_profil_mutasi',
            		'label'		=> 'Nama Jabatan',
            		'rules'		=> 'required'
            ),		
            array(
            		'field'		=> 'wilayah',
            		'label'		=> 'Wilayah',
            		'rules'		=> 'required'
            ),	
            array(
            	'field' => 'min_pendidikan',
            	'label'	=> 'Min. Pendidikan',
            	'rules' => 'required'
            ),
            array(
            	'field' => 'min_ipk',
            	'label'	=> 'Min. IPK',
            	'rules' => 'required|numeric'
            ),            
		);

		$this->form_validation->set_rules( $rules );

		$return_message = array();

		if( $this->form_validation->run() === FALSE ){
			$return_message = ['status'=>'error','message'=>validation_errors()];
		}
		else{	

			$profil_jabatan['nama_profil_mutasi'] 	= $this->input->post('nama_profil_mutasi',true);
			$profil_jabatan['wilayah']				= $this->input->post('wilayah',true);
			$profil_jabatan['pendidikan_minimum']	= $this->input->post("min_pendidikan",true);
			$profil_jabatan['nilai']				= $this->input->post("min_ipk",true);
			$profil_jabatan['keterangan']			= $this->input->post("keterangan",true);

			$CF			= $this->input->post('CF',true);
			$CF			= intval($CF);
			$SF			= $this->input->post('SF',true);
			$SF			= intval($SF);
			$persentase_aspek = $this->input->post('persentase_aspek',true);

			if( ! $this->db->insert('profil_mutasi',$profil_jabatan) ){
				$return_message = ['status' => 'failed','message'=> $this->db->_error_message()];
			}else{
				
				$last_id 			= $this->db->insert_id();
				$daftar_subkriteria = $this->input->post('subkriterias',true);
				$daftar_nilai 		= $this->input->post('nilai',true);

				$this->db->trans_start();
				for ($i=0; $i < count( $daftar_subkriteria ) ; $i++) { 
					
					$insert_nilai = array('id_profil_mutasi'=> $last_id ,
									 'id_subkriteria'=>$daftar_subkriteria[$i],
									 'nilai'=>$daftar_nilai[$i] );

					$this->db->insert( 'nilai_profil_mutasi', $insert_nilai );
				}

			$parameter = [
				[
					'id_pm' => $last_id,
					'jenis_parameter' => 'CFP',
					'referensi' => 0,
					'nilai'		=> $CF
				],
				[
					'id_pm' => $last_id,
					'jenis_parameter' => 'SFP',
					'referensi' => 0,
					'nilai'		=> $SF
				],					
			];


			foreach ($persentase_aspek as $criteria_id => $percentage) {
				$param = [
					'id_pm' => $last_id,
					'jenis_parameter' => 'CP',
					'referensi' => $criteria_id,
					'nilai' => $percentage
				];

				array_push($parameter, $param);
			}

			$this->db->insert_batch('parameter_profil_mutasi',$parameter);


				$this->db->trans_complete();

				$return_message = array('status' => 'success','message'=> 'Data berhasil diinput');

			}

		}

		echo json_encode( $return_message );
	}

	public function edit($kode){

		$this->breadcrumb->add( array("link"=>"#","label"=>"Edit") );

		$this->load->library('parser');
		$this->db->order_by('id_kriteria','asc');
		$kriterias	= $this->db->get('kriteria')->result_array();
		$tables = array();

		array_walk($kriterias, function(&$value,&$key)use(&$tables,&$kode){
			$this->db->where('id_kriteria',$value['id_kriteria']);
			$this->db->order_by('id_subkriteria','asc');
			array_push($tables, $value['kode_kriteria']);
			$value['child'] = $this->db->get('subkriteria')->result_array();
			$temp = $this->db->query("SELECT nilai from parameter_profil_mutasi where id_pm = '$kode' and jenis_parameter = 'CP' and referensi = '".$value['id_kriteria']."'");
			$value['nilai_CP'] = ( $temp->num_rows() > 0 ? $temp->row()->nilai : 0  );
			array_walk($value['child'], function(&$value2,&$key2) use(&$kode){
				$nilai = $this->db->query("SELECT nilai FROM nilai_profil_mutasi WHERE id_subkriteria = ".$value2['id_subkriteria']." AND id_profil_mutasi = ".$kode." LIMIT 1");
				$value2['nilai'] = $nilai->num_rows() > 0 ? $nilai->row()->nilai : 1;
			});

		});

		$res_CF = $this->db->query("select * from parameter_profil_mutasi where id_pm = '$kode' and jenis_parameter = 'CFP'");
		$res_SF = $this->db->query("select * from parameter_profil_mutasi where id_pm = '$kode' and jenis_parameter = 'SFP'");
		$data['CF']				= ( $res_CF->num_rows() > 0 ? $res_CF->row()->nilai : 0 );
		$data['SF']				= ( $res_SF->num_rows() > 0 ? $res_SF->row()->nilai : 0 );
	
		$data['kriterias']   	= $kriterias;
		$data['profil']			= $this->db->query("select * from profil_mutasi where id_pm = $kode")->row();
		$data['tables']			= json_encode($tables);
		$data['output'] 		= $this->load->view('adm/profil_mutasi/edit',$data,true);
		$data['skript'] 		= $this->parser->parse('scripts/script_profil_mutasi_edit.js',array(),true);
		$data['breadcrumb'] = $this->breadcrumb->render();
		
		$this->load->view('layout',$data);
	}

	public function update(){

		$this->load->library('form_validation');

		$rules = array(
            array(
            		'field'		=> 'nama_profil_mutasi',
            		'label'		=> 'Nama Jabatan',
            		'rules'		=> 'required'
            ),		
            array(
            		'field'		=> 'wilayah',
            		'label'		=> 'Wilayah',
            		'rules'		=> 'required'
            ),
            array(
            	'field' => 'min_pendidikan',
            	'label'	=> 'Min. Pendidikan',
            	'rules' => 'required'
            ),
            array(
            	'field' => 'min_ipk',
            	'label'	=> 'Min. IPK',
            	'rules' => 'required|numeric'
            ), 
		);

		$this->form_validation->set_rules( $rules );

		$return_message = array();

		if( $this->form_validation->run() == FALSE ){
			$return_message = ['status'=>'error','message'=>validation_errors()];
		}
		else{	

			$profil_jabatan['nama_profil_mutasi'] 	= $this->input->post('nama_profil_mutasi',true);
			$profil_jabatan['wilayah']				= $this->input->post('wilayah',true);
			$profil_jabatan['pendidikan_minimum']	= $this->input->post("min_pendidikan",true);
			$profil_jabatan['nilai']				= $this->input->post("min_ipk",true);
			$profil_jabatan['keterangan']			= $this->input->post("keterangan",true);

			$id_pm									= $this->input->post('kode_profil_hidden',true);

			$CF			= $this->input->post('CF',true);
			$CF			= intval($CF);
			$SF			= $this->input->post('SF',true);
			$SF			= intval($SF);
			$persentase_aspek = $this->input->post('persentase_aspek',true);

			$this->db->where('id_pm',$id_pm);

			if( ! $this->db->update('profil_mutasi',$profil_jabatan) ){
				$return_message = ['status' => 'failed','message'=> $this->db->_error_message()];
			}else{
				$daftar_subkriteria = $this->input->post('subkriterias',true);
				$daftar_nilai 		= $this->input->post('nilai',true);

				$this->db->trans_start();
				for ($i=0; $i < count( $daftar_subkriteria ) ; $i++) { 
					
					$insert_nilai = [
									 'nilai'=>$daftar_nilai[$i] 
									];
					$this->db->where('id_profil_mutasi',$id_pm);
					$this->db->where('id_subkriteria',$daftar_subkriteria[$i]);
					$this->db->update( 'nilai_profil_mutasi', $insert_nilai );
				}


			$parameter = [
				[
					'id_pm' => $id_pm,
					'jenis_parameter' => 'CFP',
					'referensi' => 0,
					'nilai'		=> $CF
				],
				[
					'id_pm' => $id_pm,
					'jenis_parameter' => 'SFP',
					'referensi' => 0,
					'nilai'		=> $SF
				],					
			];


			foreach ($persentase_aspek as $criteria_id => $percentage) {
				$param = [
					'id_pm' => $id_pm,
					'jenis_parameter' => 'CP',
					'referensi' => $criteria_id,
					'nilai' => $percentage
				];

				array_push($parameter, $param);
			}

			$this->db->delete("parameter_profil_mutasi",array('id_pm'=>$id_pm));
			$this->db->insert_batch('parameter_profil_mutasi',$parameter);				

				$this->db->trans_complete();

				$return_message = ['status' => 'success','message'=> 'Data berhasil diupdate'];

			}

		}

		echo json_encode( $return_message );
	}

	public function hapus($kode){
		$this->db->where('id_pm', $kode);
		 
		return ( $this->db->delete('profil_mutasi') );
	}

	public function getSubkriteriaList($kriteria){

		$this->db->where('id_kriteria',$kriteria);
		$result = $this->db->get('subkriteria')->result();	
		echo json_encode( $result );
	}


	public function kandidat(){

		$this->breadcrumb->add( array("link"=>"#","label"=>"Pilih kandidat") );		

		$this->load->library('parser');
		$result = $this->db->query("SELECT 
								`id_pm`,`nama_profil_mutasi`,`wilayah`, 
								( SELECT 
										COUNT(*) 
								   FROM kandidat 
								   WHERE id_profil = id_pm 
								) AS jumlah_kandidat 
							FROM profil_mutasi ")->result();
		$data['profiles']		=	$result;
		$data['output'] 		= 	$this->load->view("adm/profil_mutasi/kandidat",$data,true);
		$data['skript']			=	$this->parser->parse('scripts/script_profil_list.js',array(),true);
		$data['styles'] 	= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$data['scripts'] 	= array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );

		$data['breadcrumb'] = $this->breadcrumb->render();

		$this->load->view('layout',$data);

	}

	public function pilih_kandidat($id){

		$this->load->model("ModelPegawai");

		$this->breadcrumb->add( array("link"=>site_url("pegawai"),"label"=>"Pilih Kandidat") );

		$this->db->where('id_pm',$id);
		$this->db->select();
		$profil_mutasi = $this->db->get("profil_mutasi")->row();

		$pegawai	=  $this->ModelPegawai->getPegawaiListAsObjectWithCriteria( $profil_mutasi->pendidikan_minimum, $profil_mutasi->nilai );
		$data['output'] 	=  $this->load->view('adm/profil_mutasi/pilih_kandidat',compact('id','pegawai','profil_mutasi'),true);
		
		$data['styles'] 	= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$data['scripts'] 	= array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );
		$data['skript'] 	= $this->load->view('scripts/script_pilih_kandidat.js',null,true);
		$data['breadcrumb'] = $this->breadcrumb->render();

		$this->load->view('layout',$data);		

	}

	public function kandidat_ajax($id){

		$this->load->model("ModelPegawai");		

		$this->db->where('id_pm',$id);
		$this->db->select();
		$profil_mutasi = $this->db->get("profil_mutasi")->row();

		$pegawai	=  $this->ModelPegawai->getPegawaiListAsObjectWithCriteria( $profil_mutasi->pendidikan_minimum, $profil_mutasi->nilai );
		$output 	=  $this->load->view('adm/penilaian/qualified_candidate',compact('id','pegawai','profil_mutasi'),true);

		echo $output;
	}


	public function simpan_kandidat(){

		$this->load->library("form_validation");

		$rules = array(
            array(
            		'field'		=> 'id_kandidat',
            		'label'		=> 'Kandidat',
            		'rules'		=> 'required'
            ),		
            array(
            		'field'		=> 'id_profil',
            		'label'		=> 'Profil Mutasi',
            		'rules'		=> 'required'
            ),
		);

		$this->form_validation->set_rules( $rules );

		if( $this->form_validation->run() == FALSE ){
			echo json_encode(array('status'=>'error','message'=>validation_errors()));
		}else{

			$kandidat = $this->input->post("id_kandidat",true);
			$id_profil = $this->input->post("id_profil");

			$this->db->trans_start();

			$this->db->where('id_profil',$id_profil);
			$this->db->delete("kandidat");

			for ($i=0; $i < count($kandidat) ; $i++) { 
				$kddt = array(
					'id_profil' => $id_profil,
					'id_pegawai' => $kandidat[$i]
				);

				$this->db->insert( "kandidat" , $kddt );
			}

			$this->db->trans_complete();

			echo json_encode( array('status'=>'success','message'=>'Berhasil disimpan') );
		}

	}

	public function getParam($kode){

		$res_CF = $this->db->query("select * from parameter_profil_mutasi where id_pm = '$kode' and jenis_parameter = 'CFP'");
		$res_SF = $this->db->query("select * from parameter_profil_mutasi where id_pm = '$kode' and jenis_parameter = 'SFP'");
		$CF				= ( $res_CF->num_rows() > 0 ? $res_CF->row()->nilai : 0 );
		$SF				= ( $res_SF->num_rows() > 0 ? $res_SF->row()->nilai : 0 );
		
		$this->db->select("id_kriteria");
		$kriterias	= $this->db->get('kriteria')->result_array();

		$final_kriteria = array();

		array_walk($kriterias, function(&$value,&$key)use($kode){
			$temp = $this->db->query("SELECT nilai from parameter_profil_mutasi where id_pm = '$kode' and jenis_parameter = 'CP' and referensi = '".$value['id_kriteria']."'");
			$value['value'] = ( $temp->num_rows() > 0 ? $temp->row()->nilai : 0  );
		});

		array_walk($kriterias, function(&$value,&$key) use(&$final_kriteria){
			$final_kriteria[$value['id_kriteria']] = $value['value'];
		});

		$this->db->where("id_profil",$kode);
		$this->db->select("id_pegawai");
		$candidates = $this->db->get("kandidat")->result_array();

		$final_candidates = array();

		array_walk($candidates, function($value,$key)use(&$final_candidates){
			array_push($final_candidates,$value['id_pegawai']);
		});

		$returnJson = array(
			'cf' => $CF,
			'sf' => $SF,
			'pa' => $final_kriteria,
			'candidates' => $final_candidates
		);

		echo json_encode($returnJson);
	}
}