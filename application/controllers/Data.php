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
            'start' => $this->input->post('range_jam1'),
            'end' => $this->input->post('range_jam2')
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
    $saveeditj = [
        'start' => $this->input->post('start'),
        'end' => $this->input->post('end')
    ];
    // $start = $this->input->post('r1');
    $data = $this->Data_model->saveeditjam($kode,$saveeditj);
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
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
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
}

// end Tahun ajaran 

// start MASTER STATUS DOSEN
public function statusdosen()
{

    $data['title'] = 'Master Status Dosen';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    
    $this->form_validation->set_rules('stat_dosen', 'Status Dosen', 'required');
    if ($this->form_validation->run() == false)
    {
        // echo "OK";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/status_dosen', $data);
        $this->load->view('templates/footer');  
    } else {
        $insertStatusDosen = [
            'status ' => $this->input->post('stat_dosen')
        ];

        $this->Data_model->addstatusdosen($insertStatusDosen);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/statusdosen');

    }
}

public function statusdosenList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getstatusDosenMaster($postData);

    echo json_encode($data);
}

public function targetStatusDosen($kode='')
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->getStatusDosenbyKode($kode);
    echo json_encode($data);  
}

public function statusdosendelete()
{
   $kode=$this->input->post('kode');
   $data=$this->Data_model->dellstatusdosen($kode);
   echo json_encode($data); 
   $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
           // redirect('data/jam');
}

public function editStatusDosen()
{
    $kode = $this->input->post('kode');
    $saveeditsd = [
        'status' => $this->input->post('status') 
    ];
    // $status = $this->input->post('status');
    
    $data = $this->Data_model->saveeditSD($kode, $saveeditsd);
    // var_dump($saveeditsd);
    // die;
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
}
// end MASTER STATUS DOSEN

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
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
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
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
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
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
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
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
}

// end MASTER TYPE RUANGAN

// start MASTER TYPE MATA KULIAH

public function typematkul()
{
    $data['title'] = 'Master Type Matakuliah';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('namamk', 'Nama', 'required');
    $this->form_validation->set_rules('ket', 'Keterangan', 'required');
    if ($this->form_validation->run() == false)
    {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('matakuliah/type_matakuliah', $data);
        $this->load->view('templates/footer');
    } else {
        $insertdataTypeMatkul = [
            'nama_typemk' => $this->input->post('namamk'),
            'keterangan_typemk' => $this->input->post('ket')
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
        'nama_typemk' => $this->input->post('nama_typemk'),
        'keterangan_typemk' => $this->input->post('keterangan_typemk')
    ];
    $data = $this->Data_model->saveedittypematkul($idtpel, $saveedittypematkul);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
}

// end MASTER TYPE MATA KULIAH

// start MASTER MATA KULIAH

public function matkul()
{
    $data['title'] = 'Master Matakuliah';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['kelom'] = $this->Data_model->getKelompoKelas()->result_array();
    $data['typ'] = $this->Data_model->getTypeMK()->result_array();
    $data['par'] = $this->Data_model->getPMK()->result_array();
    $data['prod'] = $this->Data_model->getProdi()->result_array();
    $data['smes'] = $this->Data_model->getsmester()->result_array();
    $this->form_validation->set_rules('kel', 'Kelompok Matakuliah', 'required');
    $this->form_validation->set_rules('kodemk', 'Kode Matakuliah', 'required');
    $this->form_validation->set_rules('namamk', 'Nama Matakuliah', 'required');
    $this->form_validation->set_rules('typemk', 'Type Matakuliah', 'required');
    $this->form_validation->set_rules('parmk', 'Pararel Matakuliah', 'required');
    $this->form_validation->set_rules('smk', 'Semester Matakuliah', 'required');
    $this->form_validation->set_rules('prod', 'Prodi', 'required');
    $this->form_validation->set_rules('jj', 'Prodi', 'required');
    if ($this->form_validation->run() == false)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('matakuliah/index', $data);
        $this->load->view('templates/footer');
    } else {
        $saveMK = [
            'id_kelompok' => $this->input->post('kel'),
            'nama_kode' => $this->input->post('kodemk'),
            'nama' => $this->input->post('namamk'),
            'id_type' => $this->input->post('typemk'),
            'id_pararel' => $this->input->post('parmk'),
            'id_semester_tipe' => $this->input->post('smk'),
            'kode_prodi' => $this->input->post('prod'),
            'jumlah_jam' => $this->input->post('jj')
        ];
        $this->Data_model->addmatkul($saveMK);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/matkul');

    }

}

public function matkulList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getMatkulMaster($postData);

    echo json_encode($data);
}

public function tagetMatKul($kode='')
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->getMatKulbyKode($kode);
    echo json_encode($data);  
}

public function matkuldelete()
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->dellmatkul($kode);
    echo json_encode($data); 
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editMatKul()
{
    $kode = $this->input->post('kode');
    $saveeditmatkul = [
        'nama' => $this->input->post('nama'),
        'id_kelompok' => $this->input->post('id_kelompok'),
        'nama_kode' => $this->input->post('nama_kode'),
        'id_type' => $this->input->post('id_type'),
        'id_pararel' => $this->input->post('id_pararel'),
        'id_semester_tipe' => $this->input->post('id_semester_tipe'),
        'kode_prodi' => $this->input->post('kode_prodi'),
        'jumlah_jam' => $this->input->post('jumlah_jam')
    ];
    // var_dump($saveeditmatkul);
    // die;
    $data = $this->Data_model->saveeditMatKul($kode, $saveeditmatkul);
// data: {kode:kode, id_kelompok:id_kelompok, nama_kode:nama_kode, nama:nama, id_type:id_type, id_jenis_mk:id_jenis_mk, semester:semester, kode_prodi:kode_prodi, jumlah_jam:jumlah_jam},
    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
}

// end MASTER MATA KULIAH

// start MASTER PARAREL MATA KULIAH
public function pararelmatkul()
{
    $data['title'] = 'Master Pararel Matakuliah';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('namapar', 'Nama Pararel Matakuliah', 'required');

    if ($this->form_validation->run() == false)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('matakuliah/pararel_matakuliah', $data);
        $this->load->view('templates/footer');
    } else {
        $savePMK = [
            'keterangan' => $this->input->post('namapar')
        ];
        $this->Data_model->addpararelmatkul($savePMK);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/pararelmatkul');

    }

}

public function pararelmatkulList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getPararelMatkulMaster($postData);

    echo json_encode($data);
}

public function targetPararelMatKul($idjmk='')
{
    $idjmk=$this->input->post('idjmk');
    $data=$this->Data_model->getPararelMatKulbyKode($idjmk);
    echo json_encode($data);  
}

public function pararelmatkuldelete()
{
   $idjmk=$this->input->post('idjmk');
   $data=$this->Data_model->dellpararelmatkul($idjmk);
   echo json_encode($data); 
   $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editpararelMatKul()
{
    $idjmk = $this->input->post('idjmk');
    $saveeditpararelmatkul = [
        'keterangan' => $this->input->post('keterangan')
    ];
    $data = $this->Data_model->saveeditparmatkul($idjmk, $saveeditpararelmatkul);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
}
// end MASTER JENIS MATA KULIAH

// start MASTER KELOMPOK KELAS

public function kelkelas()
{
    $data['title'] = 'Master Kelompok Kelas';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('nama_kel', 'Kelompok Matakuliah', 'required');
    $this->form_validation->set_rules('ket_kel', 'Keterangan Matakuliah', 'required');
    if ($this->form_validation->run() == false)
    {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/index', $data);
        $this->load->view('templates/footer');
    } else {
        $insertdataKelKelas = [
            'nama_kelompok_kelas' => $this->input->post('nama_kel'),
            'ket_kelompok' => $this->input->post('ket_kel')
        ]; 
        $this->Data_model->addkelkelas($insertdataKelKelas);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/kelkelas');
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

public function targetKelKelas($idk='')
{
    $idk=$this->input->post('idk');
    $data=$this->Data_model->getKelKelasbyKode($idk);
    echo json_encode($data);  
}

public function kelkelasdelete()
{
   $idk=$this->input->post('idk');
   $data=$this->Data_model->dellkelkelas($idk);
   echo json_encode($data); 
   $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editkelKelas()
{
    $idk = $this->input->post('idk');
    $saveeditkk = [
        'nama_kelompok_kelas' => $this->input->post('nama_kelompok_kelas'),
        'ket_kelompok' => $this->input->post('ket_kelompok')
    ];
    $data = $this->Data_model->saveeditkelkelas($idk, $saveeditkk);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');
}

// end MASTER KELOMPOK MATA KULIAH

// Start MASTER PRODI
public function prodi()
{
    $data['title'] = 'Master Prodi';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['fakul'] = $this->Data_model->getFakultas()->result_array();
    $idp = $this->Nomor_model->getidProdi();

    $this->form_validation->set_rules('koprod', 'Kode Prodi', 'required|trim|is_unique[prodi.id_prodi]', [
        'is_unique' => '<div class="alert alert-danger">This Kode has already!</div>'
    ]);
    $this->form_validation->set_rules('nama_pro', 'Nama Prodi', 'required');
    $this->form_validation->set_rules('fak', 'Nama Fakultas', 'required');
    if ($this->form_validation->run() == false)
    {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('prodi/index', $data);
        $this->load->view('templates/footer');

    } else {

        $insertdataProdi = [
            'id_prodi' => $this->input->post('koprod'),
            'nama_prodi' => $this->input->post('nama_pro'),
            'kode_fakultas' => $this->input->post('fak')
            // 'id_prodi' => $idp
        ];
        $this->Data_model->addprodi($insertdataProdi);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/prodi');

    }
}


public function prodiList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getProdiMaster($postData);

    echo json_encode($data);
}

public function tagetProdi($kode='')
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->getKelProdibyKode($kode);
    echo json_encode($data);  
}

public function prodidelete()
{
   $kode=$this->input->post('kode');
   $data=$this->Data_model->dellprodi($kode);
   echo json_encode($data); 
   $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editProdi()
{

    $kode = $this->input->post('kode');
    
    $saveeditprod = [

        'nama_prodi' => $this->input->post('nama_prodi'),
        'kode_fakultas' => $this->input->post('kode_fakultas'),
        'id_prodi' => $this->input->post('id_prodi')
    ];

    $data = $this->Data_model->saveeditprodi($kode, $saveeditprod);
    

    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been Update..</div>');
    
}
// end MASTER PRODI

// start MASTER FAKULTAS
public function fakultas()
{
    $data['title'] = 'Master Fakultas';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('fak', 'Nama Fakultas', 'required|trim|is_unique[fakultas.nama_fakultas]', [
        'is_unique' => '<div class="alert alert-danger">This Nama Fakultas has already!</div>'
    ]);
    // $this->form_validation->set_rules('fak', 'Jurusan', 'required');
    if ($this->form_validation->run() == false)
    {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('fakultas/index', $data);
        $this->load->view('templates/footer');
    } else {
        $insertdataFakultas = [
            'nama_fakultas' => $this->input->post('fak')
        ];
        $this->Data_model->addfakultas($insertdataFakultas);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/fakultas');
    }
}

public function fakultasList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getFakultasMaster($postData);

    echo json_encode($data);
}

public function TargetFakultas($kode='')
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->getFakultasbyKode($kode);
    echo json_encode($data);  
}

public function fakultasdelete()
{
   $kode=$this->input->post('kode');
   $data=$this->Data_model->dellfakultas($kode);
   echo json_encode($data); 
   $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editFakultas()
{
    $kode = $this->input->post('kode');
    $saveeditfak = [
        'nama_fakultas' => $this->input->post('nama_fakultas')
    ];
    $data = $this->Data_model->saveeditfakultas($kode, $saveeditfak);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');

}
// end MASTER FAKULTAS

// start Controller MATER Semester
public function semester()
{
    $data['title'] = 'Master Semester';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // $this->form_validation->set_rules('fak', 'Nama Fakultas', 'required|trim|is_unique[fakultas.nama_fakultas]', [
    //     'is_unique' => '<div class="alert alert-danger">This Nama Fakultas has already!</div>'
    // ]);

    $this->form_validation->set_rules('nama_sms', 'Nama Semester', 'required|max_length[3]', ['max_length' => '<div class="alert alert-danger">Nama Semester cannot exceed 3 characters in length.</div>']);
    $this->form_validation->set_rules('smst', 'Semester Tipe', 'required');
    $data['smst'] = $this->Data_model->getSemesterTipe()->result_array();
    // $this->form_validation->set_rules('fak', 'Jurusan', 'required');

    if ($this->form_validation->run() == false)
    {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('semester/index', $data);
        $this->load->view('templates/footer');
    } else {
        $ids = $this->Nomor_model->getNosemester();
        $insertdataSemester = [
            'nama_semester' => $this->input->post('nama_sms'),
            'semester_tipe' => $this->input->post('smst'),
            'id_semester' => $ids
        ];
        $this->Data_model->addSemester($insertdataSemester);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/semester');
    }
}

public function semesterList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getSemesterMaster($postData);

    echo json_encode($data);
}

public function TargetSemester($kode='')
{
    $kode=$this->input->post('kode');
    $data=$this->Data_model->getSemesterbyKode($kode);
    echo json_encode($data);  
}

public function semesterdelete()
{
   $kode=$this->input->post('kode');
   $data=$this->Data_model->dellsemester($kode);
   echo json_encode($data); 
   $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
}

public function editSemester()
{
    $kode = $this->input->post('kode');
    $saveeditS = [
        'nama_semester' => $this->input->post('nama_semester'),
        'semester_tipe' => $this->input->post('semester_tipe')
    ];
    $data = $this->Data_model->saveeditSemester($kode, $saveeditS);

    
    echo json_encode($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data has been update..</div>');

}


// end Controller MASTER Semester



}