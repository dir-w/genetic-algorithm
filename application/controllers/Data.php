<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_model');
        $this->load->model('Nomor_model');
        $this->load->library('form_validation');
    }

    // jam

    public function jam()
    {
        $data['title'] = 'Master Jam';
        
        
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('range_jam1', 'Range Jam', 'required');
        $this->form_validation->set_rules('range_jam2', 'Range Jam', 'required');

        if ($this->form_validation->run() ==  false)
        {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jam/index', $data);
            $this->load->view('templates/footer');
        } else { 

         $insertdata = [
            'range_jam' => $this->input->post('range_jam1').'-'.$this->input->post('range_jam2')
        ];

                        // var_dump($data);
                        //  die; 
        $this->Data_model->addjamitem($insertdata);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/jam');
    }



}

public function jamdelete()
{
 $kode=$this->input->post('kode');
 $data=$this->Data_model->delljam($kode);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
       // redirect('data/jam');
}

public function jamgetEdit($kode='')
{
    $kode=$this->input->post('kode');

    $data=$this->Data_model->getJambyKode($kode);
    echo json_encode($data);

}


public function jamList()
{
            // POST data dari view
 $postData = $this->input->post();

            // get data dari model
 $data = $this->Data_model->getMaster($postData);

 echo json_encode($data);

}

public function editJam()
{
    $kode = $this->input->post('kode');
    $range_jam = $this->input->post('range_jam');
    $data = $this->Data_model->saveeditjam($kode,$range_jam);
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
}

    // end jam

public function hari()
{
    $data['title'] = 'Master Hari';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('hari', 'Hari', 'required');

    if ($this->form_validation->run() ==  false)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('hari/index', $data);
        $this->load->view('templates/footer');

    } else {

        $idh = $this->Nomor_model->getNohari();

        $insertdatahari = [
            'nama' => $this->input->post('hari'),
            'id_hari' => $idh
        ];

                            // var_dump($data);
                            //  die; 
        $this->Data_model->addhari($insertdatahari);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/hari');
    }   
}

public function hariList()
{
            // POST data dari view
    $postData = $this->input->post();

            // get data dari model
    $data = $this->Data_model->getHariMaster($postData);

    echo json_encode($data);

}

public function haridelete()
{
 $kode=$this->input->post('kode');
 $data=$this->Data_model->dellhari($kode);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
       // redirect('data/jam');
}


public function harigetEdit($kode='')
{
    $kode=$this->input->post('kode');

    $data=$this->Data_model->getHaribyKode($kode);
    echo json_encode($data);

}

public function editHari()
{
    $kode = $this->input->post('kode');
    $nama = $this->input->post('nama');


    $data = $this->Data_model->saveedithari($kode,$nama);
    echo json_encode($data);

}

    // end hari

    // tahun Akademik

public function takademik()
{
    $data['title'] = 'Master Tahun Akademik';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('ta1', 'Tahun Ajaran', 'required');
    $this->form_validation->set_rules('ta2', 'Tahun Ajaran', 'required');
    if ($this->form_validation->run() ==  false)
    {
     $this->load->view('templates/header', $data);
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);
     $this->load->view('ta/index', $data);
     $this->load->view('templates/footer');
 } else {
    $insertdataTA = [
        'tahun' => $this->input->post('ta1').'-'.$this->input->post('ta2')
    ];

    $this->Data_model->addta($insertdataTA);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
    redirect('data/takademik');
}

}

public function taList()
{
            // POST data dari view
    $postData = $this->input->post();

            // get data dari model
    $data = $this->Data_model->getTAMaster($postData);

    echo json_encode($data);
}

public function tadelete()
{
 $kode=$this->input->post('kode');
 $data=$this->Data_model->dellta($kode);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
           // redirect('data/jam');
}

public function tagetEdit($kode='')
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->getTAbyKode($kode);
    echo json_encode($data);  
}

public function editTA()
{
    $kode = $this->input->post('kode');
    $tahun = $this->input->post('tahun');
    $data = $this->Data_model->saveeditta($kode,$tahun);
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
}

// end Tahun ajaran 

// start Master DOSEN

public function dosen()
{

    $data['title'] = 'Master Dosen';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $idd = $this->Nomor_model->getiddosen();
    $data['stat'] = $this->Data_model->getstatusDosen()->result_array();


    $this->form_validation->set_rules('nip', 'No Induk Pegawai', 'required');
    $this->form_validation->set_rules('nama', 'Nama Pegawai', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat Pegawai', 'required');
    $this->form_validation->set_rules('telp', 'Telp/HP Pegawai', 'required|alpha_numeric');
    $this->form_validation->set_rules('status_dosen', 'Status Pegawai', 'required');
    if ($this->form_validation->run() == false)
    {
        // echo "OK";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/index', $data);
        $this->load->view('templates/footer');  
    } else {
        $insertdataDosen = [
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp'),
            'status_dosen ' => $this->input->post('status_dosen'),
            'id_guru' => $idd
        ];

        $this->Data_model->adddosen($insertdataDosen);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/dosen');

    }
}

public function tagetDeleteDosen($kode='')
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->getDosenbyKode($kode);
    echo json_encode($data);  
}

public function dosendelete()
{
 $kode=$this->input->post('kode');
 $data=$this->Data_model->delldosen($kode);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
           // redirect('data/jam');
}

public function editDosen()
{
    $kode = $this->input->post('kode');
    $nip = $this->input->post('nip');
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('alamat');
    $telp = $this->input->post('telp');
    $status_dosen = $this->input->post('status_dosen');
    $data = $this->Data_model->saveeditdosen($kode, $nip, $nama, $alamat, $telp, $status_dosen);
    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
}


public function dosenList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getDosenMaster($postData);

    echo json_encode($data);
}

// end dosen

// Start Master RUANGAN

public function ruangan()
{
    $data['title'] = 'Master Ruangan';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['ruang'] = $this->Data_model->getjenisRuangan()->result_array();
    $data['typer'] = $this->Data_model->getstatustype()->result_array();

    $this->form_validation->set_rules('id', 'ID Ruangan', 'required');
    $this->form_validation->set_rules('nama', 'Nama Ruangan', 'required');
    $this->form_validation->set_rules('kapasitas', 'Kapasitas Ruangan', 'required|alpha_numeric');
    $this->form_validation->set_rules('type', 'Type Ruangan', 'required');
    $this->form_validation->set_rules('jenis_ruangan', 'Jenis Ruangan', 'required');
    $this->form_validation->set_rules('lantai', 'Lantai Ruangan', 'required');
    if ($this->form_validation->run() == false)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ruangan/index', $data);
        $this->load->view('templates/footer');
    } else {
        $insertdataRuangan = [
            'id_ruang' => $this->input->post('id'),
            'nama' => $this->input->post('nama'),
            'kapasitas' => $this->input->post('kapasitas'),
            'id_type' => $this->input->post('type'),
            'id_jenis' => $this->input->post('jenis_ruangan'),
            'lantai' => $this->input->post('lantai')
        ];

        $this->Data_model->addruangan($insertdataRuangan);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/ruangan');
    }
}

public function ruangList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getRuangMaster($postData);

    echo json_encode($data);
}

public function tagetDeleteRuangan($kode='')
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->getRuanganbyKode($kode);
    echo json_encode($data);  
}

public function ruangandelete()
{
 $kode=$this->input->post('kode');
 $data=$this->Data_model->dellruangan($kode);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editRuangan()
{
    $kode = $this->input->post('kode');
    $id_ruang = $this->input->post('id_ruang');
    $nama = $this->input->post('nama');
    $kapasitas = $this->input->post('kapasitas');
    $id_type = $this->input->post('id_type');
    $id_jenis = $this->input->post('id_jenis');
    $lantai = $this->input->post('lantai');

    $data = $this->Data_model->saveeditruangan($kode, $nama, $kapasitas, $id_type, $lantai, $id_jenis, $id_ruang);
    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
}

// end Master Ruangan


// Start master JENIS RUANGAN

public function jenisruangan()
{
    $data['title'] = 'Master Jenis Ruangan';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('nama', 'Nama jenis Ruangan', 'required');
    $this->form_validation->set_rules('keterangan', 'Keterangan Jenis Ruangan', 'required');
    if ($this->form_validation->run() == false)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ruangan/jenis_ruangan', $data);
        $this->load->view('templates/footer');
    } else {
        $insertdataJenisRuangan = [
            'nama_jenis' => $this->input->post('nama'),
            'ket_jenis' => $this->input->post('keterangan')
        ];

        $this->Data_model->addjenisruangan($insertdataJenisRuangan);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/jenisruangan');
    }
    
}

public function jenisruangList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getJenisRuangMaster($postData);

    echo json_encode($data);
}

public function tagetJenisRuangan($idj='')
{
    $idj=$this->input->post('idj');
    $data=$this->Data_model->getJenisRuanganbyKode($idj);
    echo json_encode($data);  
}

public function jenisruangandelete()
{
 $idj=$this->input->post('idj');
 $data=$this->Data_model->delljenisruangan($idj);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editjenisRuangan()
{
    $idj = $this->input->post('idj');
    $saveedit = [
        'nama_jenis' => $this->input->post('nama_jenis'),
        'ket_jenis' => $this->input->post('ket_jenis')
    ];

    $data = $this->Data_model->saveeditjenisruangan($idj, $saveedit);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
}

// end master JENIS RUANGAN

// start MASTER TYPE RUANGAN
public function typeruangan()
{
    $data['title'] = 'Master Type Ruangan';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('nama', 'Nama Type Ruangan', 'required');
    
    if ($this->form_validation->run() == false)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ruangan/type_ruangan', $data);
        $this->load->view('templates/footer');
    } else {
        $insertdataTypeRuangan = [
            'nama_type' => $this->input->post('nama')
        ];

        $this->Data_model->addtyperuangan($insertdataTypeRuangan);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/typeruangan');
    }

}

public function typeruangList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getTypeRuangMaster($postData);

    echo json_encode($data);
}

public function tagetTypeRuangan($idt='')
{
    $idt=$this->input->post('idt');
    $data=$this->Data_model->getTypeRuanganbyKode($idt);
    echo json_encode($data);  
}

public function typeruangandelete()
{
 $idt=$this->input->post('idt');
 $data=$this->Data_model->delltyperuangan($idt);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function edittypeRuangan()
{
    $idt = $this->input->post('idt');
    $saveedittype = [
        'nama_type' => $this->input->post('nama_type')
    ];
    $data = $this->Data_model->saveedittyperuangan($idt, $saveedittype);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
}

// end MASTER TYPE RUANGAN

// start MASTER TYPE MATA KULIAH

public function typematkul()
{
    $data['title'] = 'Master Type Matakuliah';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('ket', 'Type Matakuliah', 'required');
    if ($this->form_validation->run() == false)
    {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('matakuliah/type_matakuliah', $data);
        $this->load->view('templates/footer');
    } else {
        $insertdataTypeMatkul = [
            'keterangan' => $this->input->post('ket')
        ];
        $this->Data_model->addtypematkul($insertdataTypeMatkul);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/typematkul');
    }
}

public function typeList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getTypeMaster($postData);

    echo json_encode($data);
}

public function tagetTypeMatKul($idtpel='')
{
    $idtpel=$this->input->post('idtpel');
    $data=$this->Data_model->getTypeMatKulbyKode($idtpel);
    echo json_encode($data);  
}

public function typematkuldelete()
{
 $idtpel=$this->input->post('idtpel');
 $data=$this->Data_model->delltypematkul($idtpel);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function edittypeMatKul()
{
    $idtpel = $this->input->post('idtpel');
    $saveedittypematkul = [
        'keterangan' => $this->input->post('keterangan')
    ];
    $data = $this->Data_model->saveedittypematkul($idtpel, $saveedittypematkul);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
}

// end MASTER TYPE MATA KULIAH

// start MASTER MATA KULIAH

public function matkul()
{
    $data['title'] = 'Master Matakuliah';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('matakuliah/index', $data);
    $this->load->view('templates/footer');

}

public function matkulList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getMatkulMaster($postData);

    echo json_encode($data);
}

// end MASTER MATA KULIAH

// start MASTER KELOMPOK MATA KULIAH

public function kelmatkul()
{
    $data['title'] = 'Master Kelompok Matakuliah';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('nama_kel', 'Kelompok Matakuliah', 'required');
    $this->form_validation->set_rules('ket_kel', 'Keterangan Matakuliah', 'required');
    if ($this->form_validation->run() == false)
    {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('matakuliah/kelompok_matakuliah', $data);
        $this->load->view('templates/footer');
    } else {
        $insertdataKelMatkul = [
            'nama_kelompok_mk' => $this->input->post('nama_kel'),
            'ket_kelompok' => $this->input->post('ket_kel')
        ];
        $this->Data_model->addkelmatkul($insertdataKelMatkul);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/kelmatkul');
    }
}

public function kelmatkulList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getKelMatkulMaster($postData);

    echo json_encode($data);
}

public function tagetKelMatKul($idk='')
{
    $idk=$this->input->post('idk');
    $data=$this->Data_model->getKelMatKulbyKode($idk);
    echo json_encode($data);  
}

public function kelmatkuldelete()
{
 $idk=$this->input->post('idk');
 $data=$this->Data_model->dellkelmatkul($idk);
 echo json_encode($data); 
 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editkelMatKul()
{
    $idk = $this->input->post('idk');
    $saveeditkelmatkul = [
        'nama_kelompok_mk' => $this->input->post('nama_kelompok_mk'),
        'ket_kelompok' => $this->input->post('ket_kelompok')
    ];
    $data = $this->Data_model->saveeditkelmatkul($idk, $saveeditkelmatkul);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
}

// end MASTER KELOMPOK MATA KULIAH






}