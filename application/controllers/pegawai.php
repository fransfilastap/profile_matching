<?php

class pegawai extends CI_Controller{


	public function __construct(){
		parent::__construct();

		if( check_adm_login() == FALSE ){		
			redirect('login');
		}
		
		$this->load->model('ModelPegawai');

		$this->load->library('breadcrumb');
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->add( array("link"=>'#',"label"=>"Data Pegawai") );
	}


	public function index(){

		$this->breadcrumb->add( array("link"=>site_url("pegawai"),"label"=>"Profile Mutasi") );

		$pegawai['pegawai']	=  $this->ModelPegawai->getPegawaiListAsObject();
		$data['output'] 	=  $this->load->view('adm/pegawai/list',$pegawai,true);
		
		$data['styles'] 	= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$data['scripts'] 	= array( 
								base_url('assets/data-tables/jquery.dataTables.js'),
								base_url('assets/data-tables/DT_bootstrap.js'), 
				  			  );
		$data['skript'] 	= $this->load->view('scripts/script_pegawai.js',null,true);
		$data['breadcrumb'] = $this->breadcrumb->render();

		$this->load->view('layout',$data);
	}

	public function tambah(){

		$this->breadcrumb->add( array("link"=>"#","label"=>"Tambah") );

		$data['output'] 	= $this->load->view("adm/pegawai/add",null,true);
		$data['styles'] 	= array( base_url('assets/data-tables/DT_bootstrap.css') );
		$data['scripts'] 	= array( 
								base_url('assets/bootstrap/js/bootstrap-fileupload.js'),
								base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.js'), 
								base_url('assets/bootstrap-daterangepicker/date.js'),
								base_url('assets/bootstrap-daterangepicker/daterangepicker.js'),
								base_url('assets/bootstrap-timepicker/js/bootstrap-timepicker.js')
				  			  );
		$data['skript'] 	= $this->load->view('scripts/script_pegawai_add.js',null,true);
		$data['breadcrumb'] = $this->breadcrumb->render();

		$this->load->view('layout',$data);
	}

	public function simpan(){

		$this->load->library('form_validation');

		$rules = array(
			array(
				'field' => 'kode_pegawai',
				'label' => 'Kode Pegawai',
				'rules' => 'required'
			),
			array(
				'field' => 'nama_pegawai',
				'label' => 'Nama Pegawai',
				'rules' => 'required'
			),
			array(
				'field' => 'tempat_lahir',
				'label' => 'Tempat Lahir',
				'rules' => 'required'
			),
			array(
				'field' => 'tanggal_lahir',
				'label' => 'Tanggal Lahir',
				'rules' => 'required'
			),						
			array(
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'required'
			),						
		);

		$notification = array();

		$this->form_validation->set_rules( $rules );

		if( $this->form_validation->run() == FALSE ){
			$notification = [ 'status' => 'failed','message'=> validation_errors() ];
		}else{

			$pegawai['kd_pegawai'] 		= $this->input->post('kode_pegawai',true);
			$pegawai['nama_pegawai']	= $this->input->post('nama_pegawai',true);
			$pegawai['tempat_lahir']	= $this->input->post('tempat_lahir',true);
			$pegawai['tanggal_lahir']	= $this->input->post('tanggal_lahir',true);
			$pegawai['diangkat_per']	= $this->input->post('diangkat_per',true);
			$pegawai['alamat']			= $this->input->post('alamat',true);
			$pegawai['jenis_kelamin']	= $this->input->post("jenis_kelamin",true);

			if( $this->db->insert('pegawai',$pegawai) ){

				$last_id 			= $this->db->insert_id();
				$jenjang			= $this->input->post('jenjang',true);
				$institusi 			= $this->input->post('institusi',true);
				$jurusan			= $this->input->post('jurusan',true);
				$ipk				= $this->input->post('ipk',true);
				$tahun_masuk		= $this->input->post('tahun_masuk',true);
				$tahun_keluar		= $this->input->post('tahun_keluar',true);

				$nama_kursus		= $this->input->post('nama_kursus',true);
				$tempat 			= $this->input->post('tempat',true);
				$lamanya			= $this->input->post('lamanya',true);
				$keterangan 		= $this->input->post('keterangan',true);

				$jabatan 			= $this->input->post("jabatan",true);
				$wilayah 			= $this->input->post("wilayah",true);
				$dari 				= $this->input->post("dari",true);
				$sampai 			= $this->input->post("sampai",true);
				$ket 				= $this->input->post("ket",true);

				$this->db->trans_start();

				for ($i=0; $i < count( $jenjang); $i++) { 
					
					$pendidikan = array(
						'id_pegawai' 	=> $last_id,
						'institusi'		=> $institusi[$i],
						'tingkat'		=> $jenjang[$i],
						'jurusan'		=> $jurusan[$i],
						'tahun_masuk'	=> $tahun_masuk[$i],
						'tahun_keluar'	=> $tahun_keluar[$i],
						'nilai'			=> $ipk[$i]
					);

					$this->db->insert('pendidikan_pegawai',$pendidikan);

				}

				for ($i=0; $i < count( $nama_kursus ) ; $i++) { 
					$pendidikan_nonformal = array(
						'id_pegawai'	=> $last_id,
						'nama_kursus' 	=> $nama_kursus[$i],
						'tempat'		=> $tempat[$i],
						'lamanya' 		=> $lamanya[$i],
						'keterangan' 	=> $keterangan[$i]
					);

					$this->db->insert('pendidikan_nonformal',$pendidikan_nonformal);
				}

				for ($i=0; $i < count($jabatan) ; $i++) { 
					$jabatan_nya = array(
						'id_pegawai' => $last_id,
						'jabatan'    => $jabatan[$i],
						'wilayah'	 => $wilayah[$i],
						'dari'	 	=> $dari[$i],
						'sampai' 	=> $sampai[$i],
						'keterangan'	=> $keterangan[$i]
					);

					$this->db->insert("riwayat_jabatan",$jabatan_nya);
				}

				$this->db->trans_complete();
				

				$notification = ['status'=>'success','message'=>'Data pegawai berhasil disimpan'];

			}else{
				$notification = ['status'=>'failed','message'=> $this->db->_error_message()];
			}


		}


		echo json_encode( $notification );

	}

	public function edit( $kode ){

		$this->breadcrumb->add( array("link"=>"#","label"=>"Edit") );

		$pegawai 	 	 	= $this->ModelPegawai->getDataPegawai( $kode );
		$pendidikans 	 	= $this->ModelPegawai->getPendidikanPegawai( $pegawai->id );
		$nonformals 	 	= $this->ModelPegawai->getPendidikanNonFormalPegawai( $pegawai->id );
		$jabatans = $this->ModelPegawai->getRiwayatJabatanPegawai( $kode );
		$output		 	 	= $this->load->view('adm/pegawai/edit',compact('pegawai','pendidikans','nonformals','jabatans'),true);
		$total_pendidikan 	= count( $pendidikans );
		$skript		 	 	= $this->load->view('scripts/script_pegawai_edit.js',compact('total_pendidikan'),true);
		$breadcrumb 		= $this->breadcrumb->render();
		$scripts 			= array(
								base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.js'), 
								base_url('assets/bootstrap-daterangepicker/date.js'),
								base_url('assets/bootstrap-daterangepicker/daterangepicker.js'),
								base_url('assets/bootstrap-timepicker/js/bootstrap-timepicker.js')
		);

		$this->load->view('layout',compact('output','skript','breadcrumb','scripts'));
	}

	public function update(){
		
		$this->load->library('form_validation');

		$rules = array(
			array(
				'field' => 'kode_pegawai',
				'label' => 'Kode Pegawai',
				'rules' => 'required'
			),
			array(
				'field' => 'nama_pegawai',
				'label' => 'Nama Pegawai',
				'rules' => 'required'
			),
			array(
				'field' => 'tempat_lahir',
				'label' => 'Tempat Lahir',
				'rules' => 'required'
			),
			array(
				'field' => 'tanggal_lahir',
				'label' => 'Tanggal Lahir',
				'rules' => 'required'
			),						
			array(
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'required'
			),						
		);

		$notification = array();

		$this->form_validation->set_rules( $rules );

		if( $this->form_validation->run() == FALSE ){
			$notification = [ 'status' => 'failed','message'=> validation_errors() ];
		}else{

			$pegawai['kd_pegawai'] 		= $this->input->post('kode_pegawai',true);
			$pegawai['nama_pegawai']	= $this->input->post('nama_pegawai',true);
			$pegawai['tempat_lahir']	= $this->input->post('tempat_lahir',true);
			$pegawai['tanggal_lahir']	= $this->input->post('tanggal_lahir',true);
			$pegawai['diangkat_per']	= $this->input->post('diangkat_per',true);
			$pegawai['alamat']			= $this->input->post('alamat',true);
			$pegawai['jenis_kelamin']	= $this->input->post("jenis_kelamin",true);

			$id_pegawai = $this->input->post('id_pegawai',true);

			$this->db->trans_start();

			$this->db->where('id',$id_pegawai);

			if( $this->db->update('pegawai',$pegawai) ){

				$jenjang			= $this->input->post('jenjang_lama',true);
				$institusi 			= $this->input->post('institusi_lama',true);
				$jurusan			= $this->input->post('jurusan_lama',true);
				$ipk				= $this->input->post('ipk_lama',true);
				$tahun_masuk		= $this->input->post('tahun_masuk_lama',true);
				$tahun_keluar		= $this->input->post('tahun_keluar_lama',true);

				$id_ubah			= $this->input->post('id_ubah',true);
				$id_ubah2 			= $this->input->post('id_ubah2',true);
				$id_ubah3 			= $this->input->post('id_ubah3',true);


				$nama_kursus_lama	= $this->input->post('nama_kursus_lama',true);
				$tempat_lama 		= $this->input->post('tempat_lama',true);
				$lamanya_lama		= $this->input->post('lamanya_lama',true);
				$keterangan_lama 	= $this->input->post('keterangan_lama',true);

				$nama_kursus_baru	= $this->input->post('nama_kursus_baru',true);
				$tempat_baru 		= $this->input->post('tempat_baru',true);
				$lamanya_baru		= $this->input->post('lamanya_baru',true);
				$keterangan_baru 	= $this->input->post('keterangan_baru',true);


				$jabatan_lama 		= $this->input->post("jabatan_lama",true);
				$wilayah_lama 		= $this->input->post("wilayah_lama",true);
				$dari_lama			= $this->input->post("dari_lama",true);
				$sampai_lama		= $this->input->post("sampai_lama",true);
				$ket_lama 			= $this->input->post("keterangan2_lama"); 	


				$jabatan_baru 		= $this->input->post("jabatan_baru",true);
				$wilayah_baru 		= $this->input->post("wilayah_baru",true);
				$dari_baru			= $this->input->post("dari_baru",true);
				$sampai_baru		= $this->input->post("sampai_baru",true);
				$ket_baru 			= $this->input->post("keterangan2_baru"); 	
				

				if( $this->input->post('jenjang_baru',true) &&  
						$this->input->post('jenjang_baru',true) && 
							$this->input->post('jurusan_baru',true) && 
								$this->input->post('ipk_baru',true) && 
									$this->input->post('tahun_masuk_baru',true ) &&
										$this->input->post('tahun_keluar_baru',true) ){

					$jenjang_baru			= $this->input->post('jenjang_baru',true);
					$institusi_baru 		= $this->input->post('institusi_baru',true);
					$jurusan_baru			= $this->input->post('jurusan_baru',true);
					$ipk_baru				= $this->input->post('ipk_baru',true);
					$tahun_masuk_baru		= $this->input->post('tahun_masuk_baru',true);
					$tahun_keluar_baru		= $this->input->post('tahun_keluar_baru',true);



					for ($k=0; $k < count($jenjang_baru); $k++) { 
					
						$pendidikan = array(
							'id_pegawai' 	=> $id_pegawai,
							'institusi'		=> $institusi_baru[$k],
							'tingkat'		=> $jenjang_baru[$k],
							'jurusan'		=> $jurusan_baru[$k],
							'tahun_masuk'	=> $tahun_masuk_baru[$k],
							'tahun_keluar'	=> $tahun_keluar_baru[$k],
							'nilai'			=> $ipk_baru[$k]
						);
						$this->db->insert('pendidikan_pegawai',$pendidikan);					
					}				

				}


				if( $jabatan_baru ){
					for ($i=0; $i < count($jabatan_baru) ; $i++) { 
						$jabatan_nya = array(
							'id_pegawai' => $id_pegawai,
							'jabatan'    => $jabatan_baru[$i],
							'wilayah'	 => $wilayah_baru[$i],
							'dari'	 	=> $dari_baru[$i],
							'sampai' 	=> $sampai_baru[$i],
							'keterangan'	=> $ket_baru[$i]
						);

						$this->db->insert("riwayat_jabatan",$jabatan_nya);
					}
				}


				if( $nama_kursus_baru && $tempat_baru && $lamanya_baru && $keterangan_baru ){

					for ($i=0; $i < count( $nama_kursus_baru ) ; $i++) { 
						$pendidikan_nonformal = array(
							'id_pegawai'	=> $id_pegawai,
							'nama_kursus' 	=> $nama_kursus_baru[$i],
							'tempat'		=> $tempat_baru[$i],
							'lamanya' 		=> $lamanya_baru[$i],
							'keterangan' 	=> $keterangan_baru[$i]
						);

						$this->db->insert('pendidikan_nonformal',$pendidikan_nonformal);
					}
				
				}

				$id_hapus 				= $this->input->post('id_hapus',true);
				$id_hapus2 				= $this->input->post('id_hapus2',true);
				$id_hapus3				= $this->input->post("id_hapus3",true);


				for ($i=0; $i < count( $id_ubah ); $i++) { 
					
					$pendidikan = array(
						'institusi'		=> $institusi[$i],
						'tingkat'		=> $jenjang[$i],
						'jurusan'		=> $jurusan[$i],
						'tahun_masuk'	=> $tahun_masuk[$i],
						'tahun_keluar'	=> $tahun_keluar[$i],
						'nilai'			=> $ipk[$i]
					);

					$this->db->where('id_pendidikan',$id_ubah[$i]);
					$this->db->update('pendidikan_pegawai',$pendidikan);

				}

				for ($i=0; $i < count( $id_ubah2 ); $i++) { 
					
					$pendidikan_nf = array(
						'nama_kursus' => $nama_kursus_lama[$i],
						'tempat'	=> $tempat_lama[$i],
						'lamanya'	=> $lamanya_lama[$i],
						'keterangan' => $keterangan_lama[$i]
					);

					$this->db->where('id',$id_ubah2[$i]);
					$this->db->update('pendidikan_nonformal',$pendidikan_nf);

				}				

				for ($i=0; $i < count( $id_ubah3 ); $i++) { 
					
					$jabatan_tak_bertuan = array(
						'jabatan'	=> $jabatan_lama[$i],
						'wilayah'	=> $wilayah_lama[$i],
						'dari'		=> $dari_lama[$i],
						'sampai'	=> $sampai_lama[$i]
					);

					$this->db->where('id',$id_ubah3[$i]);
					$this->db->update('riwayat_jabatan',$jabatan_tak_bertuan);

				}

				for ($j=0; $j < count( $id_hapus ); $j++) { 
					$this->db->where('id_pendidikan',$id_hapus[$j]);
					$this->db->delete('pendidikan_pegawai');
				}

				for ($j=0; $j < count( $id_hapus2 ); $j++) { 
					$this->db->where('id',$id_hapus2[$j]);
					$this->db->delete('pendidikan_nonformal');
				}

				for ($j=0; $j < count( $id_hapus3 ); $j++) { 
					$this->db->where('id',$id_hapus3[$j]);
					$this->db->delete('riwayat_jabatan');
				}



				$this->db->trans_complete();
				

				$notification = ['status'=>'success','message'=>'Data pegawai berhasil disimpan'];

			}else{
				$notification = ['status'=>'failed','message'=> $this->db->_error_message()];
			}


		}


		echo json_encode( $notification );

	}

	public function view( $kode ){
		$this->breadcrumb->add( array("link"=>"#","label"=>"Detil") );

		$pegawai 	 = $this->ModelPegawai->getDataPegawai( $kode );
		$pendidikans = $this->ModelPegawai->getPendidikanPegawai( $kode );
		$pendidikanNonFormal = $this->ModelPegawai->getPendidikanNonFormalPegawai( $kode );
		$jabatans = $this->ModelPegawai->getRiwayatJabatanPegawai( $kode );
		$output  	 = $this->load->view('adm/pegawai/view',compact('pegawai','pendidikans', 'pendidikanNonFormal','jabatans'),true);
		$skript 	 = $this->load->view('scripts/script_pegawai_view.js',null,true);
		$breadcrumb  = $this->breadcrumb->render();

		$this->load->view('layout',compact('output','skript','breadcrumb'));

	}

	public function hapus( $kode ){

		$this->db->where('id',$kode);
		return $this->db->delete('pegawai');

	}

	public function cetak( $kode ){
		
		$pegawai = $this->ModelPegawai->getProfilLengkapSemuaPegawai($kode);
		$pegawai = $pegawai[0];

		$view_file = 'adm/laporan/cetak_pegawai';
		$html = $this->load->view($view_file,compact('pegawai'),true);

		ini_set('memory_limit','256M');
		include_once APPPATH.'/third_party/pdf/mpdf.php';
		$pdf = new mPDF('c','Legal','','',15,15,25,25,10,10);
		
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
		$pdf->Output("Biodata Pegawai - ".$kode.".pdf","D");
		//	echo $string_to_print;
		die();			
	}


}