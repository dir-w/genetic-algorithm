<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
* This is Data Model
*/
class Admin_model extends CI_Model
{

	public function getAnggotaNotAppproved()
	{
		$email = $this->session->userdata('email');
	    $this->db->select('*');
		$this->db->FROM('user');
		$this->db->JOIN('anggota', 'anggota.id_user = user.id');
		$this->db->JOIN('no_anggota', 'no_anggota.idaa = anggota.ida');
		$this->db->JOIN('kota', 'kota.kota_id = no_anggota.id_kota');
			
		$this->db->where('approved_niad', 0);
		// $this->db->order_by('thn_masuk', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}

	public function getInfoAnggota($idaa = '') 
	{
		// $email = $this->session->userdata('email');

		$idaa = $idaa;
	    	$this->db->select('*');
			$this->db->FROM('user');
			$this->db->JOIN('anggota', 'anggota.id_user = user.id');
			$this->db->JOIN('no_anggota', 'no_anggota.idaa = anggota.ida');
			$this->db->JOIN('kota', 'kota.kota_id = no_anggota.id_kota');
			$this->db->where('idaa',$idaa);

			$query = $this->db->get();
			return $query->row_array();
	}

	public function Get_InfoAnggotaBaru($idaa)
	{
			$this->db->select('*');
			$this->db->FROM('user');
			$this->db->JOIN('anggota', 'anggota.id_user = user.id');
			$this->db->JOIN('no_anggota', 'no_anggota.idaa = anggota.ida');
			$this->db->JOIN('kota', 'kota.kota_id = no_anggota.id_kota');
			$this->db->where('idaa',$idaa);

			$query = $this->db->get();
			return $query->row_array();
	}

	public function GetInfoA()
	{
		$this->db->select('*');
			$this->db->FROM('user');
			$this->db->JOIN('anggota', 'anggota.id_user = user.id');
			$this->db->JOIN('no_anggota', 'no_anggota.idaa = anggota.ida');
			$this->db->JOIN('kota', 'kota.kota_id = no_anggota.id_kota');
			// $this->db->where('idaa',$idaa);

			$query = $this->db->get();
			return $query->row_array();
	}

	public function getAnggotaAppproved()
	{
		$email = $this->session->userdata('email');
	    $this->db->select('*');
		$this->db->FROM('user');
		$this->db->JOIN('anggota', 'anggota.id_user = user.id');
		$this->db->JOIN('no_anggota', 'no_anggota.idaa = anggota.ida');
		$this->db->JOIN('kota', 'kota.kota_id = no_anggota.id_kota');
			
		$this->db->where('approved_niad', 1);
		// $this->db->order_by('thn_masuk', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}


}