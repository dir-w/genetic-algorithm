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
	    		"start"=>$record->start,
	    		"end"=>$record->end,
	    		"tipe_semester"=>$record->tipe_semester,
	    		"tgl_pr"=>$record->tgl_pr,
	    		"Aksi" => "
	    		<a href='javascript:void(0)' class='badge badge-danger item_hapusjurusan' data-placement='bottom' title='Delete' data-id=$record->id_pemakaian  ;'><span class='far fa-trash-alt'></span></a>
	    		<a href='javascript:void(0)' class='badge badge-warning edit_jurusan' data-placement='bottom' title='Edit' data-id=$record->id_pemakaian ;'><span class='far fa-edit'></span></a>
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
	// end Model PROSES INPUT


}