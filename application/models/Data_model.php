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

// end MASTER TYPE RUANGAN

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