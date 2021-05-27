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

public function dosen()
{

    $data['title'] = 'Master Dosen';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['stat'] = $this->Data_model->getDosen()->result_array();

    $this->form_validation->set_rules('nip', 'No Induk Pegawai', 'required');
    $this->form_validation->set_rules('nama', 'Nama Pegawai', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat Pegawai', 'required');
    $this->form_validation->set_rules('telp', 'Telp/HP Pegawai', 'required|alpha_numeric');
    $this->form_validation->set_rules('status_dosen', 'Status Pegawai', 'required');
    if ($this->form_validation->run() == false)
    {
        echo "OK";
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
            'status_dosen ' => $this->input->post('status_dosen')
        ];

    // 'tahun' => $this->input->post('ta1').'-'.$this->input->post('ta2')
    // var_dump($insertdataDosen);
    // die;
        // $this->db->insert('guru', $insertdataDosen);
        $this->Data_model->adddosen($insertdataDosen);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
        redirect('data/dosen');

    // var_dump($insertdataDosen);
    // die;

    }

}




// end dosen

public function dosenList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getDosenMaster($postData);

    echo json_encode($data);
}

public function ruangan()
{
    $data['title'] = 'Master Ruangan';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('ruangan/index', $data);
    $this->load->view('templates/footer');
}

public function ruangList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getRuangMaster($postData);

    echo json_encode($data);
}

public function jenisruangan()
{
    $data['title'] = 'Master Jenis Ruangan';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('ruangan/jenis_ruangan', $data);
    $this->load->view('templates/footer');
}

public function jenisruangList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getJenisRuangMaster($postData);

    echo json_encode($data);
}

public function typematkul()
{
    $data['title'] = 'Master Type Matakuliah';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('typemapel/index', $data);
    $this->load->view('templates/footer');
}

public function typeList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getTypeMaster($postData);

    echo json_encode($data);
}

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

public function kelmatkul()
{
    $data['title'] = 'Master Kelompok Matakuliah';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('matakuliah/kelompok_matakuliah', $data);
    $this->load->view('templates/footer');
}

public function kelmatkulList()
{
        // POST data dari view
    $postData = $this->input->post();

        // get data dari model
    $data = $this->Data_model->getKelMatkulMaster($postData);

    echo json_encode($data);
}






}