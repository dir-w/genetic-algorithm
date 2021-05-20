<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
* This is Data Model
*/
class Data_model extends CI_Model
{

	// crud jam

	// json_encode(value)


	public function getMaster($postData=null)
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
        $searchQuery = " (range_jam like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('jam')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('jam')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('jam')->result();

    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
         "no"=>$no++,
         "kode"=>$record->kode,
         "range_jam"=>$record->range_jam,



         "Aksi" => "
         <a href='javascript:void(0)' class='badge badge-danger item_hapus' data-toggle='Modal' data-placement='bottom' title='Delete' data=$record->kode ;'><span class='far fa-trash-alt'></span></a>
         <a href='javascript:void(0)' class='badge badge-warning tampilModaleditjam' data-toggle='Modal' data-target='#ModalEdit' data-placement='bottom' title='Edit' data-id=$record->kode  ;'><span class='far fa-edit'></span></a>
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

public function addjamitem($insertdata)
{
    $this->db->insert('jam', $insertdata);
}

public function delljam($kode)
{
    // $this->db->delete('jam', ['kode' => $kode]);
    $hasil=$this->db->query("DELETE FROM jam WHERE kode='$kode'");
    return $hasil;
}

public function getJambyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM jam WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'range_jam' => $data->range_jam,
                
            );
        }
    }
    return $hasil;
    
}

public function saveeditjam($kode,$range_jam)
{
    $hasil=$this->db->query("UPDATE jam SET range_jam='$range_jam' WHERE kode='$kode'");
    return $hasil;
}


// end jam

// start hari

public function getHariMaster($postData=null)
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
        $searchQuery = " (nama like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('hari')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('hari')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('hari')->result();

    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
         "no"=>$no++,
         "kode"=>$record->kode,
         "nama"=>$record->nama,


         "Aksi" => "
         <a href='javascript:void(0)' class='badge badge-danger item_hapus' data-placement='bottom' title='Delete' data=$record->kode ;'><span class='far fa-trash-alt'></span></a>
         <a href='javascript:void(0)' class='badge badge-warning edit_hari' data-placement='bottom' title='Edit' data-id=$record->kode  ;'><span class='far fa-edit'></span></a>
         "

           // <a href='javascript:void(0)' class='badge badge-warning edit_hari' data-toggle='Modal' data-target='#ModalEditHari' data-placement='bottom' title='Edit' data-id=$record->kode  ;'><span class='far fa-edit'></span></a>
           // <a class="btn btn btn-outline-success" href="" data-toggle="modal" data-target="#newHariModal">Add</a>
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

public function addhari($insertdatahari)
{
    $this->db->insert('hari', $insertdatahari);
}

public function dellhari($kode)
{
    $hasil=$this->db->query("DELETE FROM hari WHERE kode='$kode'");
    return $hasil;
}

public function getharibyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM hari WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama' => $data->nama,
                'id_hari'=>$data->id_hari,
                
            );
        }
    }
    return $hasil;
    
}

public function saveedithari($kode,$nama)
{
    $hasil=$this->db->query("UPDATE hari SET nama='$nama' WHERE kode='$kode'");
    return $hasil;
}


// end hari

public function getTAMaster($postData=null)
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
        $searchQuery = " (tahun like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('tahun_akademik')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('tahun_akademik')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('tahun_akademik')->result();

    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
         "no"=>$no++,
         "tahun"=>$record->tahun,


         "Aksi" => "
         <a href='javascript:void(0)' class='badge badge-danger item_hapus' data-placement='bottom' title='Delete' data=$record->kode ;'><span class='far fa-trash-alt'></span></a>
         <a href='javascript:void(0)' class='badge badge-warning edit_hari' data-placement='bottom' title='Edit' data-id=$record->kode ;'><span class='far fa-edit'></span></a>
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

public function getDosenMaster($postData=null)
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
        $searchQuery = " (nip like '%".$searchValue."%' or nama  like '%".$searchValue."%' or alamat  like '%".$searchValue."%' ) ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('guru')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('guru')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
       $this->db->where($searchQuery);
   $this->db->order_by($columnName, $columnSortOrder);
   $this->db->limit($rowperpage, $start);
   $this->db->select('guru.*', 'status_dosen.kode as kd', 'status_dosen.status');
   $this->db->from('guru');
   $this->db->join('status_dosen', 'guru.status_dosen=status_dosen.kode');
   $records = $this->db->get()->result();

   $data = array();

   $no = 1;
   foreach($records as $record ){

    $data[] = array( 
     "no"=>$no++,
     "nip"=>$record->nip,
     "nama"=>$record->nama,
     "alamat"=>$record->alamat,
     "telp"=>$record->telp,
     "status_dosen"=> $record->status,
           // "status_dosen"=> if ($record->status_dosen == "1") {"11"} else {"22"
             # code...
           // },

           // $record->status_dosen,           

     "Aksi" => "
     <a href='#' class='badge badge-primary' data-toggle='modal' data-target='#detailAnggotaModal' data-placement='bottom' title='detail'><span class='fas fa-info'></span></a>
     <a href='#' class='badge badge-warning' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='far fa-edit'></span></a>
     <a href='#' class='badge badge-danger' data-toggle='tooltip' data-placement='bottom' title='Delete' onclick='return confirm('Are you sure want to delete?...');'><span class='far fa-trash-alt'></span></a>
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

public function getRuangMaster($postData=null)
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
        $searchQuery = " (id_ruang like '%".$searchValue."%' or nama  like '%".$searchValue."%' or kapasitas  like '%".$searchValue."%' or jenis  like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('ruang')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('ruang')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
       $this->db->where($searchQuery);
   $this->db->order_by($columnName, $columnSortOrder);
   $this->db->limit($rowperpage, $start);
   $this->db->select('ruang.*', 'jenis_ruang');
   $this->db->from('ruang');
   $this->db->join('jenis_ruang', 'ruang.id_jenis=jenis_ruang.idj');
     // $this->db->join('jurusan', 'prodi.kode_jurusan=jurusan.kode');
   $records = $this->db->get()->result();

   $data = array();

   $no = 1;
   foreach($records as $record ){

    $data[] = array( 
     "no"=>$no++,
     "id_ruang"=>$record->id_ruang,
     "nama"=>$record->nama,
     "kapasitas"=>$record->kapasitas,
     "type"=>$record->type,
     "id_jenis"=>$record->nama_jenis,


     "Aksi" => "
     <a href='#' class='badge badge-primary' data-toggle='modal' data-target='#detailAnggotaModal' data-placement='bottom' title='detail'><span class='fas fa-info'></span></a>
     <a href='#' class='badge badge-warning' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='far fa-edit'></span></a>
     <a href='#' class='badge badge-danger' data-toggle='tooltip' data-placement='bottom' title='Delete' onclick='return confirm('Are you sure want to delete?...');'><span class='far fa-trash-alt'></span></a>
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

public function getJenisRuangMaster($postData=null)
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
        $searchQuery = " (nama_jenis like '%".$searchValue."%' or ket_jenis  like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('jenis_ruang')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('jenis_ruang')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
       $this->db->where($searchQuery);
   $this->db->order_by($columnName, $columnSortOrder);

     // $this->db->join('jurusan', 'prodi.kode_jurusan=jurusan.kode');
   $records = $this->db->get('jenis_ruang')->result();

   $data = array();

   $no = 1;
   foreach($records as $record ){

    $data[] = array( 
     "no"=>$no++,
     "nama_jenis"=>$record->nama_jenis,
     "ket_jenis"=>$record->ket_jenis,


     "Aksi" => "
     <a href='#' class='badge badge-primary' data-toggle='modal' data-target='#detailAnggotaModal' data-placement='bottom' title='detail'><span class='fas fa-info'></span></a>
     <a href='#' class='badge badge-warning' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='far fa-edit'></span></a>
     <a href='#' class='badge badge-danger' data-toggle='tooltip' data-placement='bottom' title='Delete' onclick='return confirm('Are you sure want to delete?...');'><span class='far fa-trash-alt'></span></a>
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

public function getTypeMaster($postData=null)
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
        $searchQuery = " (keterangan like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('typepelajaran')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('typepelajaran')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
       $this->db->where($searchQuery);
   $this->db->order_by($columnName, $columnSortOrder);
   $this->db->limit($rowperpage, $start);
     // $this->db->select('matapelajaran.*', 'prodi.kode as kprod', 'prodi.nama_prodi', 'jurusan.kode as kjus', 'jurusan.nama_jurusan');
     // $this->db->from('matapelajaran');
     // $this->db->join('prodi', 'matapelajaran.kode_prodi=prodi.kode');
     // $this->db->join('jurusan', 'prodi.kode_jurusan=jurusan.kode');
   $records = $this->db->get('typepelajaran')->result();

   $data = array();

   $no = 1;
   foreach($records as $record ){

    $data[] = array( 
     "no"=>$no++,
     "keterangan"=>$record->keterangan,



     "Aksi" => "
     <a href='#' class='badge badge-primary' data-toggle='modal' data-target='#detailAnggotaModal' data-placement='bottom' title='detail'><span class='fas fa-info'></span></a>
     <a href='#' class='badge badge-warning' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='far fa-edit'></span></a>
     <a href='#' class='badge badge-danger' data-toggle='tooltip' data-placement='bottom' title='Delete' onclick='return confirm('Are you sure want to delete?...');'><span class='far fa-trash-alt'></span></a>
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

public function getMatkulMaster($postData=null)
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
        $searchQuery = " (nama like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('matapelajaran')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('matapelajaran')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
       $this->db->where($searchQuery);
   $this->db->order_by($columnName, $columnSortOrder);
   $this->db->limit($rowperpage, $start);
   $this->db->select('matapelajaran.*');
   $this->db->from('matapelajaran', 'kelompokmk.*', 'typepelajaran.*');
   $this->db->join('typepelajaran', 'matapelajaran.id_type=typepelajaran.idt', "left");
   $this->db->join('kelompokmk', 'matapelajaran.id_kelompok=kelompokmk.idk');
     // $this->db->join('kelompokmk', 'matapelajaran.id_kelompok=kelompokmk.idk', "left");
   $records = $this->db->get()->result();


   $data = array();

   $no = 1;
   foreach($records as $record ){

    $data[] = array( 
     "no"=>$no++,
     "nama_kelompok_mk"=>$record->nama_kelompok_mk,
     "nama_kode"=>$record->nama_kode,
     "nama"=>$record->nama,

     "keterangan"=>$record->keterangan,
     "jenis"=>$record->jenis,
     "semester"=>$record->semester,




     "Aksi" => "
     <a href='#' class='badge badge-primary' data-toggle='modal' data-target='#detailAnggotaModal' data-placement='bottom' title='detail'><span class='fas fa-info'></span></a>
     <a href='#' class='badge badge-warning' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='far fa-edit'></span></a>
     <a href='#' class='badge badge-danger' data-toggle='tooltip' data-placement='bottom' title='Delete' onclick='return confirm('Are you sure want to delete?...');'><span class='far fa-trash-alt'></span></a>
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

public function getKelMatkulMaster($postData=null)
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
        $searchQuery = " (nama_kelompok_mk like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('kelompokmk')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('kelompokmk')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
       $this->db->where($searchQuery);
   $this->db->order_by($columnName, $columnSortOrder);
   $this->db->limit($rowperpage, $start);
     // $this->db->select('*');
     // $this->db->from('matapelajaran', 'kelompokmk.*', 'typepelajaran.*');
     // $this->db->join('typepelajaran', 'matapelajaran.id_type=typepelajaran.idt', "left");
     // $this->db->join('kelompokmk', 'matapelajaran.id_kelompok=kelompokmk.idk');
     // $this->db->join('kelompokmk', 'matapelajaran.id_kelompok=kelompokmk.idk', "left");
   $records = $this->db->get('kelompokmk')->result();


   $data = array();

   $no = 1;
   foreach($records as $record ){

    $data[] = array( 
     "no"=>$no++,
     "nama_kelompok_mk"=>$record->nama_kelompok_mk,
     "ket_kelompok"=>$record->ket_kelompok,





     "Aksi" => "
     <a href='#' class='badge badge-primary' data-toggle='modal' data-target='#detailAnggotaModal' data-placement='bottom' title='detail'><span class='fas fa-info'></span></a>
     <a href='#' class='badge badge-warning' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='far fa-edit'></span></a>
     <a href='#' class='badge badge-danger' data-toggle='tooltip' data-placement='bottom' title='Delete' onclick='return confirm('Are you sure want to delete?...');'><span class='far fa-trash-alt'></span></a>
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







}