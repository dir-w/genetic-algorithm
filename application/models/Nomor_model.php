<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
* This is Data Model
*/
class Nomor_model extends CI_Model
{

	public function getNohari()
	{
		$this->db->select('RIGHT(hari.id_hari,2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('hari');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}
		else {      
		   //jika kode belum ada      
			$kode = 1;    
		}

		$kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "H".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}

	public function getidDosen()
	{
		$this->db->select('RIGHT(guru.id_guru,4) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('guru');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}
		else {      
		   //jika kode belum ada      
			$kode = 1;    
		}

		$kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "D".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}

	public function getidProdi()
	{
		$this->db->select('RIGHT(prodi.id_prodi,4) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('prodi');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}
		else {      
		   //jika kode belum ada      
			$kode = 1;    
		}

		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "P".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}


}