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
         "start"=>$record->start,
         "end"=>$record->end,



         "Aksi" => "
         <a href='javascript:void(0)' class='badge badge-danger item_hapus' data-toggle='Modal' data-placement='bottom' title='Delete' data-id=$record->kode ;'><span class='far fa-trash-alt'></span></a>
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
                'start' => $data->start,
                'end' => $data->end,
                'gab' => $data->start.'-'.$data->end,
            );
        }
    }
    return $hasil;
    
}

public function saveeditjam($kode,$saveeditj)
{
    // $hasil=$this->db->query("UPDATE jam SET range_jam='$range_jam' WHERE kode='$kode'");
    // return $hasil;
    $this->db->where('kode', $kode);
    $this->db->update('jam', $saveeditj);
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


// start tahun ajaran

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
         "kode"=>$record->kode,
         "tahun"=>$record->tahun,


         "Aksi" => "
         <a href='javascript:void(0)' class='badge badge-danger item_hapusta' data-placement='bottom' title='Delete' data=$record->kode ;'><span class='far fa-trash-alt'></span></a>
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

public function addta($insertdataTA)
{
    $this->db->insert('tahun_akademik', $insertdataTA);
}

public function dellta($kode)
{
    $hasil=$this->db->query("DELETE FROM tahun_akademik WHERE kode='$kode'");
    return $hasil;
}

public function getTAbyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM tahun_akademik WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'tahun' => $data->tahun, 
            );
        }
    }
    return $hasil;  
}

public function saveeditta($kode,$tahun)
{
    $hasil=$this->db->query("UPDATE tahun_akademik SET tahun='$tahun' WHERE kode='$kode'");
    return $hasil;
}

// end tahun ajaran

// start STATUS DOSEN

public function getstatusDosenMaster($postData=null)
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
        $searchQuery = " (status like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('status_dosen')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('status_dosen')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
 // $this->db->select('*');
 // $this->db->from('status_dosen');
 // $this->db->join('status_dosen', 'guru.status_dosen=status_dosen.kode');
 // $records = $this->db->get()->result();
    $records = $this->db->get('status_dosen')->result();

    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
         "no"=>$no++,
         "kode"=>$record->kode,
         "status"=>$record->status,


         "Aksi" => "
         <a href='javascript:void(0)' class='badge badge-danger item_hapusstatusdosen' data-placement='bottom' title='Delete' data=$record->kode data-id=$record->kode ;'><span class='far fa-trash-alt'></span></a>
         <a href='javascript:void(0)' class='badge badge-warning edit_statusdosen' data-placement='bottom' title='Edit' data-id=$record->kode ;'><span class='far fa-edit'></span></a>"
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

public function addstatusdosen($insertStatusDosen)
{
    $this->db->insert('status_dosen', $insertStatusDosen);
}

public function getStatusDosenbyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM status_dosen WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'status' => $data->status,
            );
        }
    }
    return $hasil;  
}

public function dellstatusdosen($kode)
{
    $hasil=$this->db->query("DELETE FROM status_dosen WHERE kode='$kode'");
    return $hasil;
}

public function saveeditSD($kode, $saveeditsd)
{
  // $hasil=$this->db->query("UPDATE status_dosen SET status='$status' WHERE kode='$kode'");
  // return $hasil;
    $this->db->where('kode', $kode);
    $this->db->update('status_dosen', $saveeditsd);
}
// end STATUS DOSEN


// start DOSEN
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
     "kode"=>$record->kode,
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
     <a href='javascript:void(0)' class='badge badge-danger item_hapusdosen' data-placement='bottom' title='Delete' data=$record->kode data-id=$record->kode ;'><span class='far fa-trash-alt'></span></a>
     <a href='javascript:void(0)' class='badge badge-warning edit_dosen' data-placement='bottom' title='Edit' data-id=$record->kode ;'><span class='far fa-edit'></span></a>"
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

public function adddosen($insertdataDosen)
{
    $this->db->insert('guru', $insertdataDosen);
}

public function getstatusDosen()
{
    // $hsl=$this->db->query("SELECT * FROM status_dosen");
    // return $hsl;

    $this->db->select('*');
    $this->db->FROM('status_dosen');
    $query = $this->db->get();
    return $query;  
}

public function getDosenbyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM guru WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nip' => $data->nip,
                'nama' => $data->nama,
                'alamat' => $data->alamat,
                'telp' => $data->telp,
                'status' => $data->status_dosen,
            );
        }
    }
    return $hasil;  
}

public function delldosen($kode)
{
    $hasil=$this->db->query("DELETE FROM guru WHERE kode='$kode'");
    return $hasil;
}

public function saveeditdosen($kode, $nip, $nama, $alamat, $telp, $status_dosen)
{
  $hasil=$this->db->query("UPDATE guru SET nip='$nip', nama='$nama', alamat='$alamat', telp='$telp', status_dosen='$status_dosen' WHERE kode='$kode'");
  return $hasil;
}

// END DOSEN

// start ruangan master

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
    $this->db->select('ruang.*', 'jenis_ruang.*, type_ruang.*');
    $this->db->from('ruang');
    $this->db->join('jenis_ruang', 'ruang.id_jenis=jenis_ruang.idj');
    $this->db->join('type_ruang', 'ruang.id_type=type_ruang.idt');
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
            "type"=>$record->nama_type,
            "nama_jenis"=>$record->nama_jenis,
            "lantai"=>$record->lantai,


            "Aksi" => "
            <a href='javascript:void(0)' class='badge badge-danger item_hapusruangan' data-placement='bottom' title='Delete' data=$record->kode data-id=$record->kode ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_ruangan' data-placement='bottom' title='Edit' data-id=$record->kode ;'><span class='far fa-edit'></span></a>
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

public function getstatustype()
{
    $this->db->select('*');
    $this->db->FROM('type_ruang');
    $query = $this->db->get();
    return $query;  
}

public function getjenisRuangan()
{

    $this->db->select('*');
    $this->db->FROM('jenis_ruang');
    $query = $this->db->get();
    return $query;  
}

public function addruangan($insertdataRuangan)
{
    $this->db->insert('ruang', $insertdataRuangan);
}

public function getRuanganbyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM ruang WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'id_ruang' => $data->id_ruang,
                'nama' => $data->nama,
                'kapasitas' => $data->kapasitas,
                'id_type' => $data->id_type,
                'id_jenis' => $data->id_jenis,
                'lantai' => $data->lantai,
            );
        }
    }
    return $hasil;  
}

public function dellRuangan($kode)
{
    $hasil=$this->db->query("DELETE FROM ruang WHERE kode='$kode'");
    return $hasil;
}


public function saveeditruangan($kode, $nama, $kapasitas, $id_type, $lantai, $id_jenis, $id_ruang)
{
    $hasil=$this->db->query("UPDATE ruang SET nama='$nama', kapasitas='$kapasitas', id_type='$id_type', lantai='$lantai', id_jenis='$id_jenis', id_ruang='$id_ruang' WHERE kode='$kode'");
    return $hasil;
}

// end Master Ruangan


// Start MASTER JENIS RUANGAN

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
            <a href='javascript:void(0)' class='badge badge-danger item_hapusjenisruangan' data-placement='bottom' title='Delete' data-id=$record->idj  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_jenisruangan' data-placement='bottom' title='Edit' data-id=$record->idj ;'><span class='far fa-edit'></span></a>
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

public function addjenisruangan($insertdataJenisRuangan)
{
    $this->db->insert('jenis_ruang', $insertdataJenisRuangan);
}

public function getJenisRuanganbyKode($idj)
{
    $hsl=$this->db->query("SELECT * FROM jenis_ruang WHERE idj='$idj'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama_jenis' => $data->nama_jenis,
                'ket_jenis' => $data->ket_jenis,
            );
        }
    }
    return $hasil;  
}

public function delljenisruangan($idj)
{
    $hasil=$this->db->query("DELETE FROM jenis_ruang WHERE idj='$idj'");
    return $hasil;
}

public function saveeditjenisruangan($idj, $saveedit)
{
    $this->db->where('idj', $idj);
    $this->db->update('jenis_ruang', $saveedit);
}

// end MASTER JENIS RUANGAN


// start MASTER TYPE RUANGAN
public function getTypeRuangMaster($postData=null)
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
        $searchQuery = " (nama_type like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('type_ruang')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('type_ruang')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);

     // $this->db->join('jurusan', 'prodi.kode_jurusan=jurusan.kode');
    $records = $this->db->get('type_ruang')->result();

    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
            "no"=>$no++,
            "nama_type"=>$record->nama_type,
            "Aksi" => "
            <a href='javascript:void(0)' class='badge badge-danger item_hapustyperuangan' data-placement='bottom' title='Delete' data-id=$record->idt  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_typeruangan' data-placement='bottom' title='Edit' data-id=$record->idt ;'><span class='far fa-edit'></span></a>
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

public function addtyperuangan($insertdataTypeRuangan)
{
    $this->db->insert('type_ruang', $insertdataTypeRuangan);
}

public function getTypeRuanganbyKode($idt)
{
    $hsl=$this->db->query("SELECT * FROM type_ruang WHERE idt='$idt'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama_type' => $data->nama_type,
            );
        }
    }
    return $hasil;  
}

public function delltyperuangan($idt)
{
    $hasil=$this->db->query("DELETE FROM type_ruang WHERE idt='$idt'");
    return $hasil;
}

public function saveedittyperuangan($idt, $saveedittype)
{
    $this->db->where('idt', $idt);
    $this->db->update('type_ruang', $saveedittype);
}

// end MASTER TYPE RUANGAN

// start MASTER TYPE MATA KULIAH

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
        $searchQuery = " (nama_typemk like '%".$searchValue."%') ";
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
            "nama_typemk"=>$record->nama_typemk,
            "keterangan_typemk"=>$record->keterangan_typemk,
            "Aksi" => "
            <a href='javascript:void(0)' class='badge badge-danger item_hapustypematkul' data-placement='bottom' title='Delete' data-id=$record->idtpel  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_typematkul' data-placement='bottom' title='Edit' data-id=$record->idtpel ;'><span class='far fa-edit'></span></a>
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

public function addtypematkul($insertdataTypeMatkul)
{
    $this->db->insert('typepelajaran', $insertdataTypeMatkul);
}

public function getTypeMatKulbyKode($idtpel)
{
    $hsl=$this->db->query("SELECT * FROM typepelajaran WHERE idtpel='$idtpel'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama_typemk' => $data->nama_typemk,
                'keterangan_typemk' => $data->keterangan_typemk,
            );
        }
    }
    return $hasil;  
}

public function delltypematkul($idtpel)
{
    $hasil=$this->db->query("DELETE FROM typepelajaran WHERE idtpel='$idtpel'");
    return $hasil;
}

public function saveedittypematkul($idtpel, $saveedittypematkul)
{
    $this->db->where('idtpel', $idtpel);
    $this->db->update('typepelajaran', $saveedittypematkul);
}


// end MASTER TYPE MATA KULIAH

// start MASTER MATA KULIAH

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
    $this->db->from('matapelajaran', 'kelompokmk.*', 'typepelajaran.*', 'pararel.*', 'prodi.*', 'semester_tipe.*');
    $this->db->join('typepelajaran', 'matapelajaran.id_type=typepelajaran.idtpel', "left");
    $this->db->join('kelompokkelas', 'matapelajaran.id_kelompok=kelompokkelas.idk');
    $this->db->join('pararel', 'matapelajaran.id_pararel=pararel.idjmk');
    $this->db->join('prodi', 'matapelajaran.kode_prodi=prodi.kode');
    $this->db->join('semester_tipe', 'matapelajaran.id_semester_tipe=semester_tipe.kode');
    $records = $this->db->get()->result();


    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
            "no"=>$no++,
            "nama_kelompok_kelas"=>$record->nama_kelompok_kelas,
            "nama_kode"=>$record->nama_kode,
            "nama"=>$record->nama,

            "nama_typemk"=>$record->nama_typemk,
            "keterangan"=>$record->keterangan,
            "semester"=>$record->tipe_semester,
            "nama_prodi"=>$record->nama_prodi,




            "Aksi" => "
            
            <a href='javascript:void(0)' class='badge badge-danger item_hapusmatkul' data-placement='bottom' title='Delete' data-id=$record->kode  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_matkul' data-placement='bottom' title='Edit' data-id=$record->kode ;'><span class='far fa-edit'></span></a>
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

public function getKelompoKelas()
{
    $this->db->select('*');
    $this->db->FROM('kelompokkelas');
    $query = $this->db->get();
    return $query;  
}

public function getTypeMK()
{
    $this->db->select('*');
    $this->db->FROM('typepelajaran');
    $query = $this->db->get();
    return $query;  
}

public function getPMK()
{
    $this->db->select('*');
    $this->db->FROM('pararel');
    $query = $this->db->get();
    return $query;  
}

public function getProdi()
{
    $this->db->select('*');
    $this->db->FROM('prodi');
    $query = $this->db->get();
    return $query;  
}

public function getsmester()
{
    $this->db->select('*');
    $this->db->FROM('semester_tipe');
    $query = $this->db->get();
    return $query;  
}

public function addmatkul($saveMK)
{
    $this->db->insert('matapelajaran', $saveMK);
}

public function getMatKulbyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM matapelajaran WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama' => $data->nama,
                'id_kelompok' => $data->id_kelompok,
                'nama_kode' => $data->nama_kode,
                'id_type' =>$data->id_type,
                'id_pararel' => $data->id_pararel,
                'id_semester_tipe' => $data->id_semester_tipe,
                'kode_prodi' => $data->kode_prodi,
                'jumlah_jam' => $data->jumlah_jam,
            );
        }
    }
    return $hasil;  
}

public function dellmatkul($kode)
{
    $hasil=$this->db->query("DELETE FROM matapelajaran WHERE kode='$kode'");
    return $hasil;
}

public function saveeditMatKul($kode, $saveeditmatkul)
{

    $this->db->where('kode', $kode);
    $this->db->update('matapelajaran', $saveeditmatkul);
}

// end MASTER MATA KULIAH

// start MASTER KELOMPOK KELAS

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
        $searchQuery = " (nama_kelompok_kelas like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('kelompokkelas')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('kelompokkelas')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('kelompokkelas')->result();


    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
            "no"=>$no++,
            "nama_kelompok_kelas"=>$record->nama_kelompok_kelas,
            "ket_kelompok"=>$record->ket_kelompok,
            "Aksi" => "
            <a href='javascript:void(0)' class='badge badge-danger item_hapuskelkelas' data-placement='bottom' title='Delete' data-id=$record->idk  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_kelkelas' data-placement='bottom' title='Edit' data-id=$record->idk ;'><span class='far fa-edit'></span></a>
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

public function addkelkelas($insertdataKelKelas)
{
    $this->db->insert('kelompokkelas', $insertdataKelKelas);
}

public function getKelKelasbyKode($idk)
{
    $hsl=$this->db->query("SELECT * FROM kelompokkelas WHERE idk='$idk'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama_kelompok_kelas' => $data->nama_kelompok_kelas,
                'ket_kelompok' => $data->ket_kelompok,
            );
        }
    }
    return $hasil;  
}

public function dellkelkelas($idk)
{
    $hasil=$this->db->query("DELETE FROM kelompokkelas WHERE idk='$idk'");
    return $hasil;
}

public function saveeditkelkelas($idk, $saveeditkk)
{
    $this->db->where('idk', $idk);
    $this->db->update('kelompokkelas', $saveeditkk);
}

// end MASTER KELOMPOK KELAS

// start MASTER PARAREL MATA KULIAH
public function getPararelMatkulMaster($postData=null)
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

    $records = $this->db->get('pararel')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('pararel')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    
     ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get('pararel')->result();


    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
            "no"=>$no++,
            "keterangan"=>$record->keterangan,
            
            "Aksi" => "
            <a href='javascript:void(0)' class='badge badge-danger item_hapuspararelmatkul' data-placement='bottom' title='Delete' data-id=$record->idjmk  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_pararelmatkul' data-placement='bottom' title='Edit' data-id=$record->idjmk ;'><span class='far fa-edit'></span></a>
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

public function addpararelmatkul($savePMK)
{
    $this->db->insert('pararel', $savePMK);
}

public function getPararelMatKulbyKode($idjmk)
{
    $hsl=$this->db->query("SELECT * FROM pararel WHERE idjmk='$idjmk'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'keterangan' => $data->keterangan,
            );
        }
    }
    return $hasil;  
}

public function dellpararelmatkul($idjmk)
{
    $hasil=$this->db->query("DELETE FROM pararel WHERE idjmk='$idjmk'");
    return $hasil;
}

public function saveeditparmatkul($idjmk, $saveeditpararelmatkul)
{
    $this->db->where('idjmk', $idjmk);
    $this->db->update('pararel', $saveeditpararelmatkul);
}
// end MASTER PARAREL MATA KULIAH

// start MASTER prodi
public function getProdiMaster($postData=null)
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
        $searchQuery = " (nama_prodi like '%".$searchValue."%' or id_prodi  like '%".$searchValue."%' or nama_fakultas  like '%".$searchValue."%') ";
        // $searchQuery = " (nama_prodi like '%".$searchValue."%' or id_prodi  like '%".$searchValue."%' or nama_fakultas  like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');
    $this->db->select('prodi.*', 'fakultas.*');
    $this->db->from('prodi');
    $this->db->join('fakultas', 'prodi.kode_fakultas=fakultas.kode', "left");

    $records = $this->db->get()->result();
    // $records = $this->db->get('prodi')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->select('prodi.*', 'fakultas.*');
    $this->db->from('prodi');
    $this->db->join('fakultas', 'prodi.kode_fakultas=fakultas.kode', "left");

    $records = $this->db->get()->result();
    // $records = $this->db->get('prodi')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $this->db->select('prodi.*', 'fakultas.*');
    $this->db->from('prodi');
    $this->db->join('fakultas', 'prodi.kode_fakultas=fakultas.kode', "left");

    $records = $this->db->get()->result();

    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
            "no"=>$no++,
            "id_prodi"=>$record->id_prodi,
            "nama_prodi"=>$record->nama_prodi,
            "nama_fakultas"=>$record->nama_fakultas,
            "Aksi" => "
            <a href='javascript:void(0)' class='badge badge-danger item_hapusprodi' data-placement='bottom' title='Delete' data-id=$record->kode  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_prodi' data-placement='bottom' title='Edit' data-id=$record->kode ;'><span class='far fa-edit'></span></a>
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

public function getFakultas()
{
    $this->db->select('*');
    $this->db->FROM('fakultas');
    $query = $this->db->get();
    return $query;  
}

public function addprodi($insertdataProdi)
{
    $this->db->insert('prodi', $insertdataProdi);
}

public function getKelProdibyKode($kode)
{ 
    $hsl=$this->db->query("SELECT * FROM prodi WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama_prodi' => $data->nama_prodi,
                'kode_fakultas' => $data->kode_fakultas,
                'id_prodi' => $data->id_prodi,
            );
        }
    }
    return $hasil;  
}

public function dellprodi($kode)
{
    $hasil=$this->db->query("DELETE FROM prodi WHERE kode='$kode'");
    return $hasil;
}

public function saveeditprodi($kode,  $saveeditprod)
{
    $this->db->where('kode', $kode);
    // $this->db->set('nama_prodi', $nama_prodi);
    // $this->db->set('kode_fakultas', $kode_fakultas);
    // $this->db->set('id_prodi', $id_prodi);
    // $this->db->update('prodi');
    $this->db->update('prodi', $saveeditprod);
    // $hasil=$this->db->query("UPDATE prodi SET nama_prodi='$nama_prodi', id_prodi='$id_prodi', kode_fakultas='$kode_fakultas' WHERE kode='$kode'");
    // return $hasil;
    

}
// end MASTER PRODI

// start MASTER FAKULTAS
public function getFakultasMaster($postData=null)
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
        $searchQuery = " (nama_fakultas like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');

    $records = $this->db->get('fakultas')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $records = $this->db->get('fakultas')->result();
    $totalRecordwithFilter = $records[0]->allcount;

    ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    $this->db->select('fakultas.*');
    $this->db->from('fakultas');
    

    $records = $this->db->get()->result();

    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
            "no"=>$no++,
            "nama_fakultas"=>$record->nama_fakultas,
            "Aksi" => "
            <a href='javascript:void(0)' class='badge badge-danger item_hapusfakultas' data-placement='bottom' title='Delete' data-id=$record->kode  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_fakultas' data-placement='bottom' title='Edit' data-id=$record->kode ;'><span class='far fa-edit'></span></a>
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

public function addfakultas($insertdataFakultas)
{
    $this->db->insert('fakultas', $insertdataFakultas);
}

public function getFakultasbyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM fakultas WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama_fakultas' => $data->nama_fakultas,
            );
        }
    }
    return $hasil;  
}

public function dellfakultas($kode)
{
    $hasil=$this->db->query("DELETE FROM fakultas WHERE kode='$kode'");
    return $hasil;
}

public function saveeditfakultas($kode, $saveeditfak)
{
    $this->db->where('kode', $kode);
    $this->db->update('fakultas', $saveeditfak);
}
// end MASTER FAKULTAS

// start MASTER SEMESTER
public function getSemesterMaster($postData=null)
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
        $searchQuery = " (nama_semester like '%".$searchValue."%' or tipe_semester  like '%".$searchValue."%') ";
    }

     ## Total number of records without filtering
    $this->db->select('count(*) as allcount');
    $this->db->select('semester.*', 'semester_tipe.*');
    $this->db->from('semester');
    $this->db->join('semester_tipe', 'semester.semester_tipe=semester_tipe.kode', "left");
    $records = $this->db->get()->result();
    // $records = $this->db->get('semester')->result();
    $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
    $this->db->select('count(*) as allcount');
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->select('count(*) as allcount');
    $this->db->select('semester.*', 'semester_tipe.*');
    $this->db->from('semester');
    $this->db->join('semester_tipe', 'semester.semester_tipe=semester_tipe.kode', "left");
    $records = $this->db->get()->result();
    $totalRecordwithFilter = $records[0]->allcount;

    ## Fetch records
    $this->db->select('*');
     // $this->db->select("CONCAT(' ', FirstName, LastName) AS Name");
    if($searchQuery != '')
        $this->db->where($searchQuery);
    $this->db->order_by($columnName, $columnSortOrder);
    $this->db->limit($rowperpage, $start);
    // $this->db->select('semester.*');
    // $this->db->from('semester');
    $this->db->select('semester.*', 'semester_tipe.*');
    $this->db->from('semester');
    $this->db->join('semester_tipe', 'semester.semester_tipe=semester_tipe.kode', "left");
    

    $records = $this->db->get()->result();

    $data = array();

    $no = 1;
    foreach($records as $record ){

        $data[] = array( 
            "no"=>$no++,
            "nama_semester"=>$record->nama_semester,
            "tipe_semester"=>$record->tipe_semester,
            "Aksi" => "
            <a href='javascript:void(0)' class='badge badge-danger item_hapussemester' data-placement='bottom' title='Delete' data-id=$record->kode  ;'><span class='far fa-trash-alt'></span></a>
            <a href='javascript:void(0)' class='badge badge-warning edit_semester' data-placement='bottom' title='Edit' data-id=$record->kode ;'><span class='far fa-edit'></span></a>
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

public function getSemesterTipe()
{
    $this->db->select('*');
    $this->db->FROM('semester_tipe');
    $query = $this->db->get();
    return $query;  
}

public function addSemester($insertdataSemester)
{
    $this->db->insert('semester', $insertdataSemester);
}

public function getSemesterbyKode($kode)
{
    $hsl=$this->db->query("SELECT * FROM semester WHERE kode='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'nama_semester' => $data->nama_semester,
                'semester_tipe' => $data->semester_tipe,
            );
        }
    }
    return $hasil;  
}

public function dellsemester($kode)
{
    $hasil=$this->db->query("DELETE FROM semester WHERE kode='$kode'");
    return $hasil;
}

public function saveeditSemester($kode, $saveeditS)
{
    $this->db->where('kode', $kode);
    $this->db->update('semester', $saveeditS);
}

// end MODEL MASTER SEMESTER




}