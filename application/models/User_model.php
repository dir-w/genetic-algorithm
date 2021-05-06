<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
* This is Data Model
*/
class User_model extends CI_Model
{
	 
	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->database();
	// }

	public function getView($id)
	{	
		// $id = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		// $id = $this->session->userdata['user']['id'];
		// $this->db->select('*');
		// $this->db->from('anggota');
		// $this->db->join('anggota','anggota.id_user=user.id');
		// $this->db->where('id_user',$id);

		// $query = $this->db->get();
		// return $query->row_array();
// var_dump();
		// $this->db->query('SELECT * FROM user JOIN anggota ON anggota.id_user=user.id' )
		return $this->db->get_where('anggota', array('id_user' => $id))->row();

	}
 

	public function getData()
	{
		$email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('user');
		$this->db->JOIN('anggota', 'anggota.id_user = user.id');
		
		$this->db->where('email',$email);

		$query = $this->db->get();
		return $query->row_array();
	}

	public function getData5()
	{
		$email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('user');
		$this->db->JOIN('anggota', 'anggota.id_user = user.id');
		$this->db->JOIN('gelar', 'gelar.id = anggota.gelar_id');
		$this->db->JOIN('pendidikan', 'pendidikan.id = anggota.pendidikan_id');
		$this->db->JOIN('propinsi', 'propinsi.propinsi_id = anggota.provinsi_id2');
		$this->db->JOIN('kota', 'kota.kota_id = anggota.kota_id2');
		$this->db->JOIN('kecamatan', 'kecamatan.kecamatan_id = anggota.kecamatan_id2');
		$this->db->JOIN('kelurahan', 'kelurahan.kelurahan_id = anggota.kelurahan_id2');
		$this->db->where('email',$email);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getProvkota()
	{
		// $email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('propinsi');
		// $this->db->JOIN('kota', 'kota.propinsi_id = propinsi.propinsi_id');
		$this->db->JOIN('kota', 'kota.propinsi_id = propinsi.propinsi_id', 'left');
		// $this->db->JOIN('kecamatan', 'kecamatan.kota_id = kota.kota_id', 'left');
		// $this->db->JOIN('kelurahan', 'kelurahan.kecamatan_id = kecamatan.kecamatan_id', 'left');
		$this->db->where('propinsi.propinsi_id', '19');
		$this->db->order_by('kota', 'ACS');
		// $this->db->where('provinsi1',$provinsi1);
		$query = $this->db->get();

		return $query->result();
	}



	public function getProvkota1()
	{
		// $email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('propinsi');
		// $this->db->JOIN('kota', 'kota.propinsi_id = propinsi.propinsi_id');
		$this->db->JOIN('kota', 'kota.propinsi_id = propinsi.propinsi_id', 'left');
		$this->db->JOIN('kecamatan', 'kecamatan.kota_id = kota.kota_id', 'left');
		// $this->db->JOIN('kelurahan', 'kelurahan.kecamatan_id = kecamatan.kecamatan_id', 'left');
		$this->db->where('propinsi.propinsi_id', '19');
		$this->db->order_by('kecamatan', 'ACS');
		// $this->db->where('provinsi1',$provinsi1);
		$query = $this->db->get();

		return $query->result();
	}

	public function getProvkota2()
	{
		// $email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('propinsi');
		// $this->db->JOIN('kota', 'kota.propinsi_id = propinsi.propinsi_id');
		$this->db->JOIN('kota', 'kota.propinsi_id = propinsi.propinsi_id', 'left');
		$this->db->JOIN('kecamatan', 'kecamatan.kota_id = kota.kota_id', 'left');
		$this->db->JOIN('kelurahan', 'kelurahan.kecamatan_id = kecamatan.kecamatan_id', 'left');
		$this->db->where('propinsi.propinsi_id', '19');
		$this->db->order_by('kelurahan', 'ACS');
		// $this->db->where('provinsi1',$provinsi1);
		$query = $this->db->get();

		return $query->result();
	}

	public function getKecKelur()
	{
		$email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('anggota');
		// $this->db->JOIN('anggota', 'anggota.id_user = user.id');
		$this->db->JOIN('kecamatan', 'kecamatan.kecamatan_id = anggota.kecamatan_id1');
		$this->db->JOIN('kelurahan', 'kelurahan.kelurahan_id = anggota.kelurahan_id1');
		// $this->db->where('email',$email);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getProv()
	{
		// $email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('propinsi');
		// $this->db->where('provinsi1',$provinsi1);
		$this->db->where('propinsi_id', '19');
		$query = $this->db->get();

		return $query->result();
		// $data = array();
  //       $query = $this->db->get('propinsi')->result_array();

  //       if( is_array($query) && count ($query) > 0 )
  //       {
  //       foreach ($query as $row ) 
  //       {
  //         $data[$row['propinsi']] = $row['propinsi'];
  //       }
  //       }
  //       asort($data);
  //       return $data;
	}


	public function getProvSekolah()
	{
		$this->db->select('*');
		$this->db->FROM('propinsi');
		// $this->db->where('provinsi1',$provinsi1);
		// $this->db->where('propinsi_id', '19');
		$query = $this->db->get();

		return $query->result();
	}

	public function getKot()
	{
		// $email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('kota');
		// $this->db->where('propinsi_id', '19');
		// $this->db->where('provinsi1',$provinsi1);
		$query = $this->db->get();

		return $query->result();

		// $query = $this->db->get('kota');
		// return $query;

	}

	public function getKec()
	{
		// $email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('kecamatan');
		// $this->db->where('propinsi_id', '19');
		// $this->db->where('provinsi1',$provinsi1);
		$query = $this->db->get();

		return $query->result();
	}


	public function getProvSek()
	{
		$email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('user');
		$this->db->JOIN('anggota', 'anggota.id_user = user.id');
		// $this->db->JOIN('propinsi', 'propinsi.propinsi_id = anggota.prov_sekolah_id');
		// $this->db->JOIN('kota', 'kota.kota_id = anggota.kota_id1');
		// $this->db->JOIN('kecamatan', 'kecamatan.kecamatan_id = anggota.kecamatan_id1');
		// $this->db->JOIN('kelurahan', 'kelurahan.kelurahan_id = anggota.kelurahan_id1');
		// $this->db->where('propinsi.propinsi_id','19');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getGelar()
	{
		// $email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('gelar');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function getPendidikan()
	{
		// $email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->FROM('pendidikan');
		
		$query = $this->db->get();

		return $query->result();
	}
	
	

	


}