<?php

class penilaian extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if( check_adm_login() == FALSE ){		
			redirect('login');
		}

		$this->load->model('ModelPegawai');
		$this->load->model('ProfileMatchingModel');

		$this->load->library('breadcrumb');
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Penilaian") );
				
	}

	public function index(){
				
		$this->breadcrumb->add( array("link"=>site_url("penilaian"),"label"=>"Penilaian Pegawai") );
						
		$this->load->library('parser');

		$this->db->order_by('id_kriteria','asc');
		$kriterias	= $this->db->get('kriteria')->result_array();
		$tables 	= array();
		$pegawais 	= $this->ModelPegawai->getPegawaiListAsArray();

		array_walk($kriterias, function(&$value,&$key)use(&$tables,&$pegawais){

			$this->db->where('id_kriteria',$value['id_kriteria']);
			$this->db->order_by('id_subkriteria','asc');
			array_push($tables, $value['id_kriteria']);
			$subs = $this->db->get('subkriteria')->result_array();
			$value['child'] = $subs;

			array_walk($pegawais, function(&$value2,&$key2) use(&$subs,&$value){
				
				$value2['subs_value'][$value['id_kriteria']] = isset( $value2['subs_value'][$value['id_kriteria']] ) > 0 ? $value2['subs_value'][$value['id_kriteria']] : array() ;
				
				array_walk($subs, function(&$value3,&$key3)use(&$value2,&$value){
					$this->db->where('id_pegawai',$value2['id']);
					$this->db->where('id_subkriteria',$value3['id_subkriteria']);
					$result = $this->db->get('nilai_pegawai');
					$nilai  = $result->num_rows() > 0 ? $result->row()->nilai : 1;
					array_push($value2['subs_value'][$value['id_kriteria']], [ $value3['id_subkriteria']=>$nilai ]);
				});
			});			

		});


		$output 		= $this->load->view("adm/penilaian/nilai_pegawai",compact('kriterias','pegawais'),true);

		$skript			= $this->parser->parse('scripts/script_kp_list.js',compact('tables'),true);
		$styles 		= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$scripts 		= array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );
		$breadcrumb 	= $this->breadcrumb->render();

		$this->load->view('layout',compact('output','skript','styles','scripts','breadcrumb'));	

	}


	public function penilaian_pegawai(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('form_nilai','Nilai','required|xss_clean');

		//initialize notification wrapper
		$notification = array();

		if( $this->form_validation->run()==FALSE ){
			$notification = ['status'=>'error','message'=>validation_errors()];	
		}else{

			$values = $this->input->post('form_nilai',true);

			$sql = "INSERT INTO nilai_pegawai values( ?,?,? ) ON DUPLICATE KEY UPDATE nilai = ?;";

			foreach ($values as $key => $kriteria) {
				foreach ($kriteria as $key => $pegawai) {
					foreach ($pegawai['subs'] as $key => $sub) {

						$this->db->query( $sql , array( $pegawai['idPegawai'],
														$sub['subId'],
														intval( $sub['subValue'] ),
														intval( $sub['subValue'] )
													 ) 
										);
					}
				}
			}

			$notification = ['status'=>'success','message'=>'Nilai berhasil disimpan'];

		}

		echo json_encode( $notification );
	}


	public function seleksi_mutasi(){

		$this->breadcrumb->add( array("link"=>site_url("penilaian/seleksi_mutasi"),"label"=>"Seleksi Mutasi") );	

		$pegawais 		=	$this->ModelPegawai->getPegawaiListAsArray();
		$kriterias	= $this->db->get('kriteria')->result_array();
		$tables = array();
		array_walk($kriterias, function(&$value,&$key)use(&$tables,&$pegawais){

			$this->db->where('id_kriteria',$value['id_kriteria']);
			$this->db->order_by('id_subkriteria','asc');
			array_push($tables, $value['id_kriteria']);
			$subs = $this->db->get('subkriteria')->result_array();
			$value['child'] = $subs;
			$kode = $value['id_kriteria'];

			array_walk($value['child'], function(&$value2,&$key2) use(&$kode){
				$nilai = $this->db->query("SELECT nilai FROM nilai_profil_mutasi WHERE id_subkriteria = ".$value2['id_subkriteria']." AND id_profil_mutasi = ".$kode." LIMIT 1");
				$value2['nilai'] = $nilai->num_rows() > 0 ? $nilai->row()->nilai : 1;
			});

			array_walk($pegawais, function(&$value2,&$key2) use(&$subs,&$value){
				
				$value2['subs_value'][$value['id_kriteria']] = isset( $value2['subs_value'][$value['id_kriteria']] ) > 0 ? $value2['subs_value'][$value['id_kriteria']] : array() ;
				
				array_walk($subs, function(&$value3,&$key3)use(&$value2,&$value){
					$this->db->where('id_pegawai',$value2['id']);
					$this->db->where('id_subkriteria',$value3['id_subkriteria']);
					$result = $this->db->get('nilai_pegawai');
					$nilai  = $result->num_rows() > 0 ? $result->row()->nilai : 1;
					array_push($value2['subs_value'][$value['id_kriteria']], [ $value3['id_subkriteria']=>$nilai ]);
				});
			});			

		});

		$profiles		=	$this->db->get('profil_mutasi')->result();
		$output 		= 	$this->load->view("adm/penilaian/seleksi_mutasi",compact('pegawais','profiles','kriterias'),true);
		$styles 		= 	array( base_url('assets/data-tables/DT_bootstrap.css') );

		$criterias 		=   json_encode($kriterias);
		$emp_vals		=	json_encode($pegawais);

		$skript			= 	$this->load->view('scripts/script_seleksi.js',compact('criterias','emp_vals'),true);
		$scripts 		= 	array( 
								base_url('assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js'),
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'),
								base_url('assets/flot/jquery.flot.js'),
								base_url("assets/flot/jquery.flot.categories.js"), 
				  			  );

		$breadcrumb 	=	$this->breadcrumb->render();

		$this->load->view('layout',compact('output','styles','scripts','skript','breadcrumb') );	


	}


	public function profile_matching(){


		$this->load->library('form_validation');
		

		$rules = array(

			array(
				'field' => 'peserta',
				'label' => 'Peserta',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'jabatan',
				'label' => 'Jabatan',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'CF',
				'label' => 'Core Factor',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'SF',
				'label' => 'Core Factor',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'persentase_aspek',
				'label' => 'Persentase Aspek',
				'rules' => 'required|xss_clean'
			),											
		);

		$this->form_validation->set_rules( $rules );

		if( $this->form_validation->run() == FALSE ){

			echo json_encode(['status'=>'failed','message'=>validation_errors()]);

		}else{

			$candidats  = $this->input->post('peserta',true);
			$CF			= $this->input->post('CF',true);
			$CF			= intval($CF);
			$SF			= $this->input->post('SF',true);
			$SF			= intval($SF);
			$profil 	= $this->input->post('jabatan',true);
			$persentase_aspek = $this->input->post('persentase_aspek',true);

			$gap_value_mapping = [
				'0' => 5,
				'1' => 4.5,
				'-1' => 4,
				'2' => 3.5,
				'-2' => 3,
				'3' => 2.5,
				'-3' => 2,
				'4' => 1.5,
				'-4' => 1 
			];


			$profile_values 	= $this->ProfileMatchingModel->getProfileValue( $profil );
			$candidate_values	= $this->ProfileMatchingModel->getCandidatesValue( $candidats );
			$CF_keys 			= array();
			$SF_keys			= array();
			$criterias 			= $this->ProfileMatchingModel->getCriteria();

			//bobot gap setiap peserta
			$gap_weights = array();
			$CF_SF_vals  = array();
			$sum_CF_SF_vals = array();

			//mengisi array yang menyimpan index core factor dan secondary factor
			foreach ($criterias as $key => $value) {
				$CF_keys[$value]	= $this->ProfileMatchingModel->getCFKeys( $value );
				$SF_keys[$value]	= $this->ProfileMatchingModel->getSFKeys( $value );
			}

			/* proses perhitungan gap */
			foreach ($criterias as $key => $id) {
				foreach ($candidate_values as $key1 => $candidate) {
					foreach ($candidate['subs'] as $key2 => &$subs) {
						array_walk($subs, function(&$value,&$key) use($profile_values,$key2,$gap_value_mapping){
							//menghitung selisih nilai pegawai dengan profil
							$gap 		= ( $value - $profile_values[$key2][$key] );
			
							//transformasi ke bentuk bobot
							$str_key 	= strval( $gap ); 
							$gap_weight = $gap_value_mapping[ $str_key ];
							$value 		= $gap_weight;
						});
					}

					$gap_weights[$id][$key1] = $candidate['subs'][$id];

				}
			}

			foreach ($gap_weights as $crit_id => $candidates) {

				$CF_count = count( $CF_keys[$crit_id] );
				$SF_count = count( $SF_keys[$crit_id] );

				foreach ($candidates as $can_id => $subs) {

					$CFVal = 0.0;
					$SFVal = 0.0;

					foreach ($CF_keys[$crit_id] as $key => $value) {
						$CFVal += $subs[$value];
					}

					foreach ($SF_keys[$crit_id] as $key => $value) {
						$SFVal += $subs[$value];
					}

					$CFVal = $CFVal / $CF_count;
					$SFVal = $SFVal / $SF_count;

					$CF_SF_vals[$crit_id][$can_id]['CF'] = $CFVal;
					$CF_SF_vals[$crit_id][$can_id]['SF'] = $SFVal;
					
				}
			}


			foreach ($CF_SF_vals as $crit_id => $cands) {
				foreach ($cands as $cand_id => $values) {
					$sum_CF_SF_vals[$crit_id][$cand_id] = (($values['CF']*$CF)/100) + (($values['SF']*$SF)/100);
				}
			}

			//end of computation

			$this->db->trans_start();

			$this->db->insert('analisis',['id_analisis'=>NULL,'profile_target'=>$profil,'runtime'=>NULL]);

			$id_analisis = $this->db->insert_id();

			//menyimpan data parameter analisis
			$parameter = [
				[
					'id_analisis' => $id_analisis,
					'jenis_parameter' => 'CFP',
					'referensi' => 0,
					'nilai'		=> $CF
				],
				[
					'id_analisis' => $id_analisis,
					'jenis_parameter' => 'SFP',
					'referensi' => 0,
					'nilai'		=> $SF
				],					
			];


			foreach ($persentase_aspek as $criteria_id => $percentage) {
				$param = [
					'id_analisis' => $id_analisis,
					'jenis_parameter' => 'CP',
					'referensi' => $criteria_id,
					'nilai' => $percentage
				];

				array_push($parameter, $param);
			}

			$this->db->insert_batch('parameter_analisis',$parameter);
			//selesai menyimpan parameter analisis

			//memasukan nilai total hasil anaslisis peserta
			$nilai_total_peserta = array();
			$status_sementara = array();

			$this->db->insert("keputusan",["id_analisis"=>$id_analisis,"status_keputusan"=>"draft"]);
			$id_hasil_analisis = $this->db->insert_id();

			foreach ($sum_CF_SF_vals as $criteria_id => $candidates) {
				foreach ($candidates as $candidate_id => $value) {
					$nilai = [
						'id_analisis' => $id_analisis,
						'id_peserta' => $candidate_id,
						'id_kriteria' => $criteria_id,
						'nilai_total' => $value
					];
					$this->db->insert("nilai_total_analisis_peserta",$nilai);
				}
			}

			foreach ($candidats as $key => $candidate_id) {
				$stt = [
					'id_hasil' => $id_hasil_analisis,
					'id_kandidat' => $candidate_id,
					'keputusan' => 0
				];
				array_push($status_sementara, $stt);
			}

			//$this->db->insert_batch('nilai_total_analisis_peserta',$nilai_total_peserta);
			$this->db->insert_batch('detil_keputusan',$status_sementara);
			//selesai menyimpan nilai total

			$this->db->trans_complete();

			if( $this->db->trans_status() === FALSE ){
				$this->db->trans_rollback();
				echo json_encode(['status'=>'failed','message'=>'Analisis telah selesai, tetapi sistem gagal menyimpan informasi hasil analisis. Tidak ada yg dapat kami tampilkan :(']);
			}else{
				$this->db->trans_commit();
				echo json_encode([	'status'=>'success',
									'message'=>'Analisis selesai. Hasil analisis telah disimpan di dalam database. Jadi anda dapat mengaksesnya kapanpun anda mau :)',
									'id'   => $id_analisis
								]);
			}
		}

	}

	public function getResult( $id ){
		
		//yes we can
		$this->db->select("id_kriteria,nama_kriteria,REPLACE(nama_kriteria,' ','_') AS the_key",false);
		$criteria 		= $this->db->get('kriteria')->result();
		$data_analisis 	= $this->ProfileMatchingModel->getAnalysisResult( $id );
		$tabel_hasil  	= $data_analisis['report'];
		$parameter  	= $data_analisis['param'];
		$profile 		= $data_analisis['profile'];


		$data_result_final	= compact('tabel_hasil','parameter','profile','criteria');
		$output			= $this->load->view('adm/penilaian/result',$data_result_final,true);

		echo $output;

	}

	public function datagrafik(){

		$datas = $this->ProfileMatchingModel->getAnalysisResult( $this->input->post('id',true) )['report'];

		$counter = 0;
		$banyak = count( $datas );

		$data_chart = "[";

		foreach ($datas as $key => $hasil) {

			$data_chart .= "[\"".$hasil->nama_pegawai."\",".$hasil->hasil_akhir."]";
			if( $counter < ( $banyak - 1 ) ){
				$data_chart .= ",";
			}

			$counter++;

		}	

		$data_chart .= "]";

		echo $data_chart;
	}


	public function keputusan_list(){

		if( !role("Manager") ){
			redirect("administrasi/index");
		}

		$this->db->select("analisis.id_analisis,nama_profil_mutasi,count( detil_keputusan.id_kandidat ) as jml_kandidat,wilayah,status_keputusan,runtime");
		$this->db->from('analisis');
		$this->db->join('profil_mutasi','analisis.profile_target = profil_mutasi.id_pm','left');
		$this->db->join('keputusan','keputusan.id_analisis = analisis.id_analisis','left');
		$this->db->join("detil_keputusan","keputusan.id_hasil = detil_keputusan.id_hasil","left");
		$this->db->where('status_keputusan',"draft");
		$this->db->order_by('runtime','asc');
		$this->db->group_by("analisis.id_analisis");

		$analisis = $this->db->get()->result();
		$output   = $this->load->view('adm/keputusan/list_keputusan',compact('analisis'),true);
		$skript   = $this->load->view('scripts/script_laporan.js',null,true);
		$styles   = array( base_url('assets/data-tables/DT_bootstrap.css') );
		$scripts  = array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );
		$breadcrumb = $this->breadcrumb->render();

		$this->load->view('layout',compact('output','styles','scripts','breadcrumb','skript'));	

	}


	public function keputusan($id){

		if( !role('Manager') ){
			redirect('administrasi/index');
		}

		$this->db->select("id_kriteria,nama_kriteria,REPLACE(nama_kriteria,' ','_') AS the_key",false);
		$criteria 		= $this->db->get('kriteria')->result();
		$raw_data 		= $this->ProfileMatchingModel->getDecisionDetails($id);
		$decisions  	= $raw_data['decisions'];
		$parameter  	= $raw_data['param'];
		$profile 		= $raw_data['profile'];
		$keputusan 		= $raw_data['keputusan'];

		$output   = $this->load->view('adm/keputusan/detil_list_keputusan',compact('keputusan','decisions','parameter','profile','criteria'),true);
		$skript   = $this->load->view('scripts/script_keputusan.js',null,true);
		$styles   = array( base_url('assets/data-tables/DT_bootstrap.css') );
		$scripts  = array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );
		$breadcrumb = $this->breadcrumb->render();

		$this->load->view('layout',compact('output','styles','scripts','breadcrumb','skript'));	
	}

	public function simpan_keputusan(){

		$this->load->library("form_validation");

		$this->form_validation->set_rules("id_hasil","ID Analisis","required|xss_clean");
		$this->form_validation->set_rules("keputusan","keputusan","required|xss_clean");

		$notification = array();

		if( $this->form_validation->run() == FALSE ){
			$notification = ['status'=>'error','message'=>validation_errors()];
		}else{

			$id 		= $this->input->get_post("id_hasil",true);
			$keputusan 	= $this->input->get_post("keputusan",true);

			$this->db->trans_start();

			foreach ($keputusan as $key => $decision) {
				$for_update = [ 'keputusan'=> $decision ];
				$this->db->where('id_kandidat',$key);
				$this->db->where('id_hasil',$id);
				$this->db->update('detil_keputusan',$for_update);
			}

			$this->db->where('id_hasil',$id);
			$this->db->update("keputusan",['status_keputusan'=>'final']);

			$this->db->trans_complete();

			if( $this->db->trans_status() === FALSE  ){
				$this->db->trans_rollback();
				$notification['status'] = "error";
				$notification['message'] = "Gagal menyimpan keputusan \n".$this->db->_error_messages();
			}else{
				$this->db->trans_commit();
				$notification['status'] = "success";
				$notification['message'] = "Berhasil menyimpan keputusan";
			}
		}

		echo json_encode($notification);		

	}
}