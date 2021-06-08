<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
* This is Data Model
*/
class Fasilitas_model extends CI_Model
{

	// Start Model Master Fasilitas
	public function getMasterFasilitas($postData=null)
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
        	$searchQuery = " (nama_fasilitas like '%".$searchValue."%' ) ";
        }

     ## Total number of records without filtering
        $this->db->select('count(*) as allcount');

        $records = $this->db->get('fasilitas')->result();
        $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
        	$this->db->where($searchQuery);
        $records = $this->db->get('fasilitas')->result();
        $totalRecordwithFilter = $records[0]->allcount;


     ## Fetch records
        $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
        if($searchQuery != '')
        	$this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('fasilitas')->result();

        $data = array();

        $no = 1;
        foreach($records as $record ){

        	$data[] = array( 
        		"no"=>$no++,
        		"kode_f"=>$record->kode_f,
        		"nama_fasilitas"=>$record->nama_fasilitas,



        		"Aksi" => "
        		<a href='javascript:void(0)' class='badge badge-danger item_hapusfasilitas' data-placement='bottom' title='Delete' data-id=$record->kode_f  ;'><span class='far fa-trash-alt'></span></a>
        		<a href='javascript:void(0)' class='badge badge-warning edit_fasilitas' data-placement='bottom' title='Edit' data-id=$record->kode_f ;'><span class='far fa-edit'></span></a>
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

    public function addfasilitas($insertdataF)
    {
    	$this->db->insert('fasilitas', $insertdataF);
    }

    public function getFasilitasbyKode($kode_f)
    {
    	$hsl=$this->db->query("SELECT * FROM fasilitas WHERE kode_f='$kode_f'");
    	if($hsl->num_rows()>0){
    		foreach ($hsl->result() as $data) {
    			$hasil=array(
    				'nama_fasilitas' => $data->nama_fasilitas,
    			);
    		}
    	}
    	return $hasil;  
    }

    public function dellFasilitas($kode_f)
    {
    	$hasil=$this->db->query("DELETE FROM fasilitas WHERE kode_f='$kode_f'");
    	return $hasil;
    }

    public function saveeditfasilitas($kode_f, $saveeditf)
    {
    	$this->db->where('kode_f', $kode_f);
    	$this->db->update('fasilitas', $saveeditf);
    }

    // end Model Master Fasilitas

    // start Model Master Peminjam
    // Start Model Master Fasilitas
    public function getMasterPeminjam($postData=null)
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
            $searchQuery = " (no_ppku like '%".$searchValue."%' or no_peminjam  like '%".$searchValue."%' or tgl_surat_peminjaman  like '%".$searchValue."%' or hari  like '%".$searchValue."%' or tgl_kegiatan  like '%".$searchValue."%' or kegiatan  like '%".$searchValue."%') ";
        }

     ## Total number of records without filtering
        $this->db->select('count(*) as allcount');

        $records = $this->db->get('peminjam')->result();
        $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('peminjam')->result();
        $totalRecordwithFilter = $records[0]->allcount;


     ## Fetch records
        $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
        if($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        // $records = $this->db->get('peminjam')->result();
        $this->db->select('peminjam.*', 'fasilitas.*');
        // $this->db->select('peminjam.*');
        $this->db->from('peminjam');
        $this->db->join('fasilitas', 'peminjam.id_fasilitas=fasilitas.kode_f');
        $records = $this->db->get()->result();

        $data = array();

        $no = 1;
        foreach($records as $record ){

            $data[] = array( 
                "no"=>$no++,
                // "kode_p"=>$record->kode_p,
                // "kode_f"=>$record->kode_f,
                "no_ppku"=>$record->no_ppku,
                "no_peminjam"=>$record->no_peminjam,
                "kegiatan"=>$record->kegiatan,
                "tgl_surat_peminjaman"=>$record->tgl_surat_peminjaman,
                "hari"=>$record->hari,
                "tgl_kegiatan"=>$record->tgl_kegiatan,
                
                "pj"=>$record->pj,
                "nama_fasilitas"=>$record->nama_fasilitas,



                "Aksi" => "
                <a href='javascript:void(0)' class='badge badge-danger item_hapuspeminjam' data-placement='bottom' title='Delete' data-id=$record->kode_p  ;'><span class='far fa-trash-alt'></span></a>
                <a href='javascript:void(0)' class='badge badge-warning edit_peminjam' data-placement='bottom' title='Edit' data-id=$record->kode_p ;'><span class='far fa-edit'></span></a>
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

    public function addpeminjam($insertdataP)
    {
        $this->db->insert('peminjam', $insertdataP);
    }

    public function getPeminjambyKode($kode_p)
    {
        $hsl=$this->db->query("SELECT * FROM peminjam WHERE kode_p='$kode_p'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'no_ppku' => $data->no_ppku,
                    'no_peminjam' => $data->no_peminjam,
                    'tgl_surat_peminjaman' => $data->tgl_surat_peminjaman,
                    'hari' => $data->hari,
                    'tgl_kegiatan' => $data->tgl_kegiatan,
                    'id_fasilitas' => $data->id_fasilitas,
                    'kegiatan' => $data->kegiatan,
                    'pj' => $data->pj,
                );
            }
        }
        return $hasil;  
    }

    public function dellPeminjam($kode_p)
    {
        $hasil=$this->db->query("DELETE FROM peminjam WHERE kode_p='$kode_p'");
        return $hasil;
    }

    public function getFasilitas()
    {
        $this->db->select('*');
        $this->db->FROM('fasilitas');
        $query = $this->db->get();
        return $query;  
    }

    public function saveeditpemilik($kode_p, $saveeditpem)
    {
        $this->db->where('kode_p', $kode_p);
        $this->db->update('peminjam', $saveeditpem);
    }
    // end Model Master Peminjam

    

}