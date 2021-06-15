<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
* This is Data Model
*/
class Proses_model extends CI_Model
{

	//Start Model PROSES INPUT
	public function getInputMaster($postData=null)
	{
		$response = array();

     ## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
    	$rowperpage = $postData['length']; // Rows display per page
	    $columnIndex = $postData['order'][0]['column']; // Column index
	    $columnName = $postData['columns'][$columnIndex]['data']; // Column name
	    $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
	    $searchValue = $postData['search']['value']; // Search value

	     ## Search 
	    $searchQuery = "";
	    if($searchValue != ''){
	    	$searchQuery = " (nama_jurusan like '%".$searchValue."%') ";
	    }

	     ## Total number of records without filtering
	    $this->db->select('count(*) as allcount');

	    $records = $this->db->get('pemakaian_ruangan')->result();
	    $totalRecords = $records[0]->allcount;

	     ## Total number of record with filtering
	    $this->db->select('count(*) as allcount');
	    if($searchQuery != '')
	    	$this->db->where($searchQuery);
	    $records = $this->db->get('pemakaian_ruangan')->result();
	    $totalRecordwithFilter = $records[0]->allcount;

	    ## Fetch records
	    $this->db->select('*');
	     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
	    if($searchQuery != '')
	    	$this->db->where($searchQuery);
	    $this->db->order_by($columnName, $columnSortOrder);
	    $this->db->limit($rowperpage, $start);
	    // $this->db->select('pemakaian_ruangan.*');
	    // $this->db->from('pemakaian_ruangan');
	    $this->db->select('pemakaian_ruangan.*, peminjam.*, ruang.nama as namaruang, matapelajaran.nama_kode, matapelajaran.nama as namamp, hari.nama as namahari, jam.*');
	    $this->db->from('pemakaian_ruangan');
	    $this->db->join('matapelajaran', 'pemakaian_ruangan.kode_mk=matapelajaran.kode', "left");
	    $this->db->join('peminjam', 'pemakaian_ruangan.kode_peminjam=peminjam.kode_p', "left");
	    $this->db->join('ruang', 'pemakaian_ruangan.kode_ruangan=ruang.kode', "left");
	    $this->db->join('hari', 'pemakaian_ruangan.kode_hari=hari.kode', "left");
	    $this->db->join('jam', 'pemakaian_ruangan.kode_jam=jam.kode', "left");
	    $this->db->join('semester_tipe', 'pemakaian_ruangan.kode_semester=semester_tipe.kode', "left");

	    $records = $this->db->get()->result();

	    $data = array();

	    $no = 1;
	    foreach($records as $record ){

	    	$data[] = array( 
	    		"no"=>$no++,
	    		"nama_kode"=>$record->nama_kode,
	    		"pj"=>$record->pj,
	    		"namaruang"=>$record->namaruang,
	    		"namamp"=>$record->namamp,
	    		"namahari"=>$record->namahari,
	    		"kapasitas" => $record->kapasitas,
	    		"start"=>$record->start,
	    		"end"=>$record->end,
	    		"tipe_semester"=>$record->tipe_semester,
	    		"tgl_pr"=> date('d-m-Y', strtotime($record->tgl_pr)),
	    		"Aksi" => "
	    		<a href='javascript:void(0)' class='badge badge-danger item_hapuspemakaian' data-placement='bottom' title='Delete' data-id=$record->id_pemakaian  ;'><span class='far fa-trash-alt'></span></a>
	    		<a href='javascript:void(0)' class='badge badge-warning edit_pemakaian' data-placement='bottom' title='Edit' data-id=$record->id_pemakaian ;'><span class='far fa-edit'></span></a>
	    		"
	    	); 

	    }

	     ## Response 
	    $response = array(
	    	"draw" => intval($draw),
	    	"iTotalRecords" => $totalRecords,
	    	"iTotalDisplayRecords" => $totalRecordwithFilter,
	    	"aaData" => $data
	    );


	    return $response;
	}

	public function getMatakuliah()
	{
		$this->db->select('*');
		$this->db->FROM('matapelajaran');
		$query = $this->db->get();
		return $query;  
	}

	public function getP()
	{
		$this->db->select('*');
		$this->db->FROM('peminjam');
		$query = $this->db->get();
		return $query;  
	}

	public function getH()
	{
		$this->db->select('*');
		$this->db->FROM('hari');
		$query = $this->db->get();
		return $query;  
	}

	public function getR()
	{
		$this->db->select('*');
		$this->db->FROM('ruang');
		$query = $this->db->get();
		return $query;  
	}

	public function getSE()
	{
		$this->db->select('*');
		$this->db->FROM('semester_tipe');
		$query = $this->db->get();
		return $query;  
	}

	public function getJ()
	{
		$this->db->select('*');
		$this->db->FROM('jam');
		$query = $this->db->get();
		return $query;  
	}

	public function getD()
	{
		$this->db->select('*');
		$this->db->FROM('guru');
		$query = $this->db->get();
		return $query;  
	}

	public function getMK($kode)
	{
		$hsl=$this->db->query("SELECT * FROM matapelajaran WHERE kode='$kode'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'nama' => $data->nama,				
				);
			}
		}
		return $hasil;
	}

	public function getPJ($kode_p)
	{
		$hsl=$this->db->query("SELECT * FROM peminjam WHERE kode_p='$kode_p'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kegiatan' => $data->kegiatan,				
				);
			}
		}
		return $hasil;
	}

	public function getJSE($kode)
	{
		$hsl=$this->db->query("SELECT * FROM jam WHERE kode='$kode'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'start' => $data->start,
					'end' => $data->end,				
				);
			}
		}
		return $hasil;
	}

	public function getNR($kode)
	{
		$hsl=$this->db->query("SELECT * FROM ruang WHERE kode='$kode'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kapasitas' => $data->kapasitas,				
				);
			}
		}
		return $hasil;
	}

	public function addpemakaian($insertdataPP)
	{
		// var_dump($insertdataPP);
		// die;
		$this->db->insert('pemakaian_ruangan', $insertdataPP);
	}

	public function getPemakaianbyKode($id_pemakaian)
	{
		$hsl=$this->db->query("SELECT pemakaian_ruangan.*, ruang.*, peminjam.*, matapelajaran.nama as napel FROM pemakaian_ruangan JOIN ruang on pemakaian_ruangan.kode_ruangan=ruang.kode JOIN matapelajaran on pemakaian_ruangan.kode_mk=matapelajaran.kode JOIN peminjam on pemakaian_ruangan.kode_peminjam=peminjam.kode_p WHERE id_pemakaian='$id_pemakaian'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'id_pemakaian' => $data->id_pemakaian,
					'kode_ruangan' => $data->kode_ruangan,
					'nama' => $data->nama,
					'kode_mk' => $data->kode_mk,
					'napel' => $data->napel,
					'kode_peminjam' => $data->kode_peminjam,
					'kode_jam' => $data->kode_jam,
					'kode_hari' => $data->kode_hari,
					'kode_dosen' => $data->kode_dosen,
					'kode_semester' => $data->kode_semester,
					'kapasitas' => $data->kapasitas,
					'kegiatan' => $data->kegiatan,
					'tgl_pr' => date('d/m/Y', strtotime($data->tgl_pr)),
				);
			}
		}
		return $hasil;
	}

	public function dellP($id_pemakaian)
	{
		$hasil=$this->db->query("DELETE FROM pemakaian_ruangan WHERE id_pemakaian='$id_pemakaian'");
		return $hasil;
	}

	public function saveeditpru($id_pemakaian,$saveedipr)
	{
		$this->db->where('id_pemakaian', $id_pemakaian);
		$this->db->update('pemakaian_ruangan', $saveedipr);
	}

	
	// end Model PROSES INPUT


}