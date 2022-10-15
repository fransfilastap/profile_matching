<?php

class modelpegawai extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getUserData( $email ){
		$result = $this->db->query("SELECT * FROM peserta where email = '".$email."' limit 1 ")->row();
		return $result;
	}

	public function getUserDataByID( $id ){
		$result = $this->db->query("SELECT * FROM peserta where no_peserta = '".$id."' limit 1 ")->row();
		return $result;
	}

	public function getDataPendidikan( $id ){
		$result = $this->db->query("SELECT * FROM pendidikan where no_peserta = '$id'")->row();
		return $result;
	}

	public function getDataPegawai($kode_pegawai){

		$this->db->where('id',$kode_pegawai);
		$this->db->or_where('kd_pegawai',$kode_pegawai);
		$this->db->from('pegawai');
		$result = $this->db->get()->row();

		return $result;
	}

	private function getPegawaiList($special=true){
		return $this->db->get('pegawai');
	}

	public function getPegawaiListAsArray(){

		$result = $this->getPegawaiList();

		return $result->result_array();
	}

	public function getPegawaiListAsArrayWithKeys( array $ids ){
		$this->db->where_in( 'id', $ids );
		$result = $this->db->get('pegawai');

		return $result->result_array();
	}

	public function getPegawaiListAsObject(){
		$result = $this->getPegawaiList();
		return $result->result();
	}

	public function getPendidikanPegawai($kode){
		$this->db->where('id_pegawai',$kode);
		$this->db->select("pendidikan_pegawai.*, (case 
											when tingkat = 1 then 'D3' 
											when tingkat = 2 then 'S1' 
											when tingkat = 3 then 'S2' 
											when tingkat = 4 then 'S3'
										else '' end) as jenjang_pendidikan");
		$result = $this->db->get('pendidikan_pegawai')->result();

		return $result;
	}

	public function getPendidikanNonFormalPegawai($kode){
		$this->db->where('id_pegawai',$kode);
		$result = $this->db->get('pendidikan_nonformal')->result();

		return $result;
	}

	public function getRiwayatJabatanPegawai($kode){
		$this->db->where('id_pegawai',$kode);
		$result = $this->db->get("riwayat_jabatan")->result();

		return $result;
	}

	public function getProfilLengkapSemuaPegawai($id=null){

		//seluruh data pegawai
		$this->db->select("id,kd_pegawai,jenis_kelamin,alamat,nama_pegawai,tempat_lahir,tanggal_lahir");
		if( $id!=null ){
			if( is_array($id) ){
				$this->db->where_in("id",$id);
			}else{
				$this->db->where("id",$id);
			}
		}
		$all_pegawai = $this->db->get("pegawai")->result();

		if( $id!=null ){
			if( is_array($id) ){
				$this->db->where_in("id_pegawai",$id);
			}else{
				$this->db->where("id_pegawai",$id);
			}
		}
		$all_pendidikan_formal = $this->db->get("pendidikan_pegawai")->result();
		if( $id!=null ){
			if( is_array($id) ){
				$this->db->where_in("id_pegawai",$id);
			}else{
				$this->db->where("id_pegawai",$id);
			}
		}		
		$all_pendidikan_nonformal = $this->db->get("pendidikan_nonformal")->result();
		if( $id!=null ){
			if( is_array($id) ){
				$this->db->where_in("id_pegawai",$id);
			}else{
				$this->db->where("id_pegawai",$id);
			}
		}
		$all_riwayat_jabatan = $this->db->get("riwayat_jabatan")->result();

		array_walk($all_pegawai, function(&$value,&$key) use( $all_pendidikan_formal, $all_pendidikan_nonformal, $all_riwayat_jabatan ){
			$value->{"formal"} = array();
			$value->{"non_formal"} = array();
			$value->{"jabatan"} = array();

			foreach ($all_pendidikan_formal as $key => $pf) {
				if( $pf->id_pegawai == $value->id ) array_push($value->{"formal"}, $pf);
			}

			foreach ($all_pendidikan_nonformal as $key => $pnf) {
				if( $pnf->id_pegawai == $value->id ) array_push($value->{"non_formal"}, $pnf);
			}

			foreach ($all_riwayat_jabatan as $key => $jab) {
				if( $jab->id_pegawai == $value->id ) array_push($value->{"jabatan"}, $jab);
			}

		});


		return $all_pegawai;

	}

	public function getPegawaiListAsObjectWithCriteria( $minPendidikan, $minIpk ){

		$sql = 'SELECT distinct pegawai.*,pendidikan_pegawai.*, (CASE 
						WHEN tingkat = 1 THEN "D3" 
						WHEN tingkat = 2 THEN "S1" 
						WHEN tingkat = 3 THEN "S2" 
						WHEN tingkat = 4 THEN "S3" 
						ELSE "undefined" END) tingkat_text,
					FORMAT(nilai,2) AS nilai
			FROM pendidikan_pegawai LEFT JOIN pegawai ON pegawai.id = id_pegawai WHERE tingkat = '.$minPendidikan.' AND nilai >= '.$minIpk.' GROUP BY id_pegawai' ;

		$returnX = $this->db->query($sql)->result();


		return $returnX;

	}

}