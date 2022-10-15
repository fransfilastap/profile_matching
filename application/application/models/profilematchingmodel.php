<?php class profilematchingmodel extends CI_Model{


	public function __construct(){
		parent::__construct();
	}

	public function getProfileValue($kode){

		$this->db->order_by('id_kriteria','asc');
		$this->db->select('id_kriteria');
		$kriterias	= $this->db->get('kriteria')->result_array();

		$profileValue = [];

		array_walk($kriterias, function(&$value,&$key)use(&$kode,&$profileValue){
			$this->db->select('id_subkriteria');
			$this->db->where('id_kriteria',$value['id_kriteria']);
			$this->db->order_by('id_subkriteria','asc');
			$value['child'] = $this->db->get('subkriteria')->result_array();

			$id_kriteria = intval( $value['id_kriteria'] );

			$profileValue[ $id_kriteria ] = [];


			array_walk($value['child'], function(&$value2,&$key2) use(&$kode,&$profileValue,&$value,&$id_kriteria){
				$nilai = $this->db->query("SELECT nilai FROM nilai_profil_mutasi WHERE id_subkriteria = ".$value2['id_subkriteria']." AND id_profil_mutasi = ".$kode." LIMIT 1");
				$nilai_sub = $nilai->num_rows() > 0 ? intval( $nilai->row()->nilai ) : 1;
				$id_subkriteria = intval( $value2['id_subkriteria'] );
				$profileValue[$id_kriteria][ $id_subkriteria ] = $nilai_sub;
			});

		});	


		return $profileValue;	
	}

	public function getCandidatesValue( $ids ){
		$this->db->select('id_kriteria');
		$this->db->order_by('id_kriteria','asc');
		$kriterias	= $this->db->get('kriteria')->result_array();
		$pegawais 	= $this->db->select('id')->where_in('id',$ids)->get('pegawai')->result_array();

		$candidateValues = [];

		array_walk($kriterias, function(&$value,&$key)use(&$pegawais,&$candidateValues){

			$this->db->where('id_kriteria',$value['id_kriteria']);
			$this->db->order_by('id_subkriteria','asc');
			$this->db->select('id_subkriteria');
			$subs = $this->db->get('subkriteria')->result_array();
			$value['child'] = $subs;

			array_walk($pegawais, function(&$value2,&$key2) use(&$subs,&$value,&$candidateValues){
				
				$value2['subs_value'][$value['id_kriteria']] = isset( $value2['subs_value'][$value['id_kriteria']] ) > 0 ? $value2['subs_value'][$value['id_kriteria']] : [] ;
				
				$candidateValues[$value2['id']]['subs'][intval( $value['id_kriteria'] )] = [];

				array_walk($subs, function(&$value3,&$key3)use(&$value2,&$value,&$candidateValues){
					$this->db->where('id_pegawai',$value2['id']);
					$this->db->where('id_subkriteria',$value3['id_subkriteria']);
					$this->db->select("nilai");
					$result = $this->db->get('nilai_pegawai');
					$nilai  = $result->num_rows() > 0 ? intval( $result->row()->nilai ) : 1;
					$candidateValues[$value2['id']]['subs'][intval( $value['id_kriteria'] )][ intval( $value3['id_subkriteria'] ) ] = intval( $nilai );
				});
			});			

		});

		unset( $pegawais );
		unset( $kriterias );

		return $candidateValues;
	}

	public function getCriteria(){
		$this->db->select('group_concat(id_kriteria separator ",") as criterias',false);
		$this->db->order_by('id_kriteria','asc');
		$result = $this->db->get('kriteria')->row()->criterias;

		$only_keys = explode(',', $result);

		array_walk($only_keys, function(&$value,&$key){
			$value = intval( $value );
		});

		return $only_keys;
	}

	public function getCFKeys( $kriteria ){

		$this->db->select('group_concat(id_subkriteria separator ",") as core_factors ',false);
		$this->db->where('jenis_nilai','CF');
		$this->db->where('id_kriteria',$kriteria);
		$this->db->order_by('id_subkriteria','asc');
		$result = $this->db->get('subkriteria')->row()->core_factors;

		$only_keys = explode(',', $result);

		array_walk($only_keys, function(&$value,&$key){
			$value = intval( $value );
		});


		return $only_keys;
	}


	public function getSFKeys($kriteria){

		$this->db->select('group_concat(id_subkriteria separator ",") as secondary_factors ',false);
		$this->db->where('jenis_nilai','SF');
		$this->db->where('id_kriteria',$kriteria);
		$this->db->order_by('id_subkriteria','asc');
		$result = $this->db->get('subkriteria')->row()->secondary_factors;

		$only_keys = explode(',', $result);
		
		array_walk($only_keys, function(&$value,&$key){
			$value = intval( $value );
		});
		return $only_keys;
	}


	public function getAnalysisResult( $id ){

		
		$profile 		= $this->db->query("SELECT nama_profil_mutasi,wilayah FROM analisis LEFT JOIN profil_mutasi pm ON pm.id_pm = analisis.profile_target where id_analisis = $id limit 1")->row();
		$param 	= $this->db->query("SELECT id_analisis,
											( CASE 
												WHEN jenis_parameter = 'CFP' THEN 'Persentase Core Factor' 
												WHEN jenis_parameter = 'SFP' THEN 'Persentase Sencodary Factor' 
												ELSE CONCAT('Persentase Aspek', (SELECT nama_kriteria FROM kriteria WHERE id_kriteria = referensi)) END  ) AS parameter,
											CONCAT(nilai,'%') AS persentase
										FROM parameter_analisis where id_analisis = $id")->result();
		$report 		= $this->db->query("CALL report($id)")->result();

		$return_data =  compact('report','profile','param');
		$this->db->reconnect();

		return $return_data;

	}

	public function getDecisionDetails($id){

		$profile 	= $this->db->query("SELECT nama_profil_mutasi,wilayah FROM analisis LEFT JOIN profil_mutasi pm ON pm.id_pm = analisis.profile_target where id_analisis = $id limit 1")->row();
		$keputusan  = $this->db->query("select id_hasil from keputusan where id_analisis = '$id' limit 1")->row();
		$param 		= $this->db->query("SELECT id_analisis,
											( CASE 
												WHEN jenis_parameter = 'CFP' THEN 'Persentase Core Factor' 
												WHEN jenis_parameter = 'SFP' THEN 'Persentase Sencodary Factor' 
												ELSE CONCAT('Persentase Aspek', (SELECT nama_kriteria FROM kriteria WHERE id_kriteria = referensi)) END  ) AS parameter,
											CONCAT(nilai,'%') AS persentase
										FROM parameter_analisis where id_analisis = $id")->result();
		$decisions  = $this->db->query("CALL report_2($id)")->result();
		$this->db->reconnect();

		$return_data = compact('decisions','param','profile','keputusan');

		return $return_data;
	}

	public function getPengumumanForUser($id){

		$profile 	= $this->db->query("SELECT nama_profil_mutasi,wilayah FROM analisis LEFT JOIN profil_mutasi pm ON pm.id_pm = analisis.profile_target where id_analisis = $id limit 1")->row();
		$keputusan  = $this->db->query("select id_hasil from keputusan where id_analisis = '$id' limit 1")->row();
		$param 		= $this->db->query("SELECT id_analisis,
											( CASE 
												WHEN jenis_parameter = 'CFP' THEN 'Persentase Core Factor' 
												WHEN jenis_parameter = 'SFP' THEN 'Persentase Sencodary Factor' 
												ELSE CONCAT('Persentase Aspek', (SELECT nama_kriteria FROM kriteria WHERE id_kriteria = referensi)) END  ) AS parameter,
											CONCAT(nilai,'%') AS persentase
										FROM parameter_analisis where id_analisis = $id")->result();
		$decisions  = $this->db->query("CALL pengumuman($id)")->result();
		$this->db->reconnect();

		$return_data = compact('decisions','param','profile','keputusan');

		return $return_data;
	}
}