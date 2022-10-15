<?php

class laporan extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if( check_adm_login() == FALSE ){		
			redirect('login');
		}
		if( role('Pegawai') ){
				redirect("administrasi/index");
		}
		$this->load->library('breadcrumb');
		$this->load->model('ProfileMatchingModel');
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>site_url('laporan'),"label"=>"Laporan") );
	}

	public function index(){

		$this->db->select("analisis.id_analisis,nama_profil_mutasi,count( detil_keputusan.id_kandidat ) as jml_kandidat,wilayah,status_keputusan,runtime");
		$this->db->from('analisis');
		$this->db->join('profil_mutasi','analisis.profile_target = profil_mutasi.id_pm','left');
		$this->db->join('keputusan','keputusan.id_analisis = analisis.id_analisis','left');
		$this->db->join("detil_keputusan","keputusan.id_hasil = detil_keputusan.id_hasil","left");
		$this->db->where('status_keputusan',"final");
		$this->db->order_by('runtime','asc');
		$this->db->group_by("analisis.id_analisis");

		$analisis = $this->db->get()->result();
		$output   = $this->load->view('adm/laporan/list_laporan',compact('analisis'),true);
		$skript   = $this->load->view('scripts/script_laporan.js',null,true);
		$styles   = array( base_url('assets/data-tables/DT_bootstrap.css') );
		$scripts  = array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );
		$breadcrumb = $this->breadcrumb->render();

		$this->load->view('layout',compact('output','styles','scripts','breadcrumb','skript'));		

	}

	public function cetak($id, $isDraft = false){

		$this->db->select("id_kriteria,nama_kriteria,REPLACE(nama_kriteria,' ','_') AS the_key",false);
		$criteria 		= $this->db->get('kriteria')->result();
		$data_analisis 	= $this->ProfileMatchingModel->getDecisionDetails( $id );
		$tabel_hasil  	= $data_analisis['decisions'];
		$parameter  	= $data_analisis['param'];
		$profile 		= $data_analisis['profile'];

		$view_file = ( $isDraft ? 'adm/laporan/cetak_draft' : 'adm/laporan/cetak_laporan' );
		$html = $this->load->view($view_file,compact('criteria','tabel_hasil','profil_mutasi','profile','parameter'),true);

		ini_set('memory_limit','256M');
		include_once APPPATH.'/third_party/pdf/mpdf.php';
		$pdf = new mPDF('c','A4','','',15,15,25,25,10,10);
		
		$pdf->mirrorMargins 		 = 1;	// Use different Odd/Even headers and footers and mirror margins
		$pdf->defaultheaderfontsize  = 8;	/* in pts */
		$pdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
		$pdf->defaultheaderline 	 = 1; 	/* 1 to include line below header/above footer */
		$pdf->defaultheaderline 	 = 1; 	/* 1 to include line below header/above footer */
		$pdf->defaultfooterfontsize  = 9;	/* in pts */
		$pdf->defaultfooterline 	 = 1; 	/* 1 to include line below header/above footer */
		

		$pdf->SetHTMLHeader();
		$pdf->SetFooter('Halaman {PAGENO}');
		$pdf->WriteHTML($html);
		$pdf->Output();
		//	echo $string_to_print;
		die();

	}

	public function lihat($id){

		$this->db->select("id_kriteria,nama_kriteria,REPLACE(nama_kriteria,' ','_') AS the_key",false);
		$criteria 		= $this->db->get('kriteria')->result();
		$data_analisis 	= $this->ProfileMatchingModel->getDecisionDetails( $id );
		$tabel_hasil  	= $data_analisis['decisions'];
		$parameter  	= $data_analisis['param'];
		$profile 		= $data_analisis['profile'];

		$data_result_final	= compact('tabel_hasil','parameter','profile','criteria');
		$output			= $this->load->view('adm/laporan/result',$data_result_final,true);

		$scripts 		= 	array( 
								base_url('assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js'),
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'),
								base_url('assets/flot/jquery.flot.js'),
								base_url("assets/flot/jquery.flot.categories.js"), 
				  			  );		


		$datas = $this->ProfileMatchingModel->getAnalysisResult( $id )['report'];

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

		$skript = $this->load->view("scripts/script_laporan_detil.js",compact('data_chart'),true);

		$this->breadcrumb->add(array("link"=>site_url('#'),"label"=>"Detil"));
		$breadcrumb = $this->breadcrumb->render();
		$this->load->view('layout',compact('output','styles','scripts','breadcrumb','skript'));
	}

	public function hapus_riwayat(){

		$this->db->truncate('analisis');
		$this->db->truncate('parameter_analisis');
		$this->db->truncate('nilai_total_analisis_peserta');
		
		echo json_encode( ['status'=>'success','message'=>'Berhasil'] );
	}

	public function daftar_pegawai_detil($kode=null){

		$ids = array();

		$this->load->model("ModelPegawai");

		if( is_null($kode) == FALSE ){

			$this->db->where('id_pm',$kode);
			$this->db->select();
			$profil_mutasi = $this->db->get("profil_mutasi")->row();

			$pegawai_ids	=  $this->ModelPegawai->getPegawaiListAsObjectWithCriteria( $profil_mutasi->pendidikan_minimum, $profil_mutasi->nilai );

			array_walk($pegawai_ids, function(&$value,&$key) use(&$ids){
				array_push($ids, $value->id);
			});

		}

		$profiles = $this->ModelPegawai->getProfilLengkapSemuaPegawai($ids);

		$view_file = 'adm/laporan/list_profil_peserta';
		$html = $this->load->view($view_file,compact('profiles'),true);

		ini_set('memory_limit','256M');
		include_once APPPATH.'/third_party/pdf/mpdf.php';
		$pdf = new mPDF('c','Legal-L','','',15,15,25,25,10,10);
		
		$pdf->mirrorMargins 		 = 1;	// Use different Odd/Even headers and footers and mirror margins
		$pdf->defaultheaderfontsize  = 8;	/* in pts */
		$pdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
		$pdf->defaultheaderline 	 = 1; 	/* 1 to include line below header/above footer */
		$pdf->defaultheaderline 	 = 1; 	/* 1 to include line below header/above footer */
		$pdf->defaultfooterfontsize  = 9;	/* in pts */
		$pdf->defaultfooterline 	 = 1; 	/* 1 to include line below header/above footer */
		

		$pdf->SetHTMLHeader();
		$pdf->SetFooter('Halaman {PAGENO}');
		$pdf->WriteHTML($html);
		$pdf->Output("Register_pegawai.pdf","D");
		//	echo $string_to_print;
		die();

	}


}