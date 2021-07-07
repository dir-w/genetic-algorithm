<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Input extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Data_model');
		$this->load->model('Proses_model');
		$this->load->model('Nomor_model');
		$this->load->model('Fasilitas_model');
		$this->load->library('form_validation');
	}

	// start Data DOSEN

	public function dosen()
	{

		$data['title'] = 'Data Dosen';
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
			redirect('input/dosen');

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

	// Start Data RUANGAN

	public function ruangan()
	{
		$data['title'] = 'Input Data Ruangan';
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
			redirect('input/ruangan');
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

// end Data Ruangan

	// Start DATA PRODI
	public function prodi()
	{
		$data['title'] = 'Data Prodi';
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
			redirect('input/prodi');

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
// end DATA PRODI

	// start DATA MATA KULIAH

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
			redirect('input/matkul');

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

// end DATA MATA KULIAH

	// START CONTROLLER PROSES INPUT PEMAKAIAN
	public function pemakaian()
	{
		$data['title'] = 'Input Data Pemakaian';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$namauser = $data;
		// $idh = $this->Nomor_model->getNohari();
		$data['takademik'] = $this->Proses_model->getTA()->result_array();
		$data['matakuliah'] = $this->Proses_model->getMatakuliah()->result_array();
		$data['pemin'] = $this->Proses_model->getP()->result_array();
		$data['hari'] = $this->Proses_model->getH()->result_array();
		$data['ruangan'] = $this->Proses_model->getR()->result_array();
		$data['semestertipe'] = $this->Proses_model->getSE()->result_array();
		$data['semester'] = $this->Proses_model->getSEM()->result_array();
		$data['jam'] = $this->Proses_model->getJ()->result_array();
		$data['dosen'] = $this->Proses_model->getD()->result_array();
		$this->form_validation->set_rules('ta', 'Tahun Akademik', 'required');
		$this->form_validation->set_rules('smst', 'Semester', 'required');
		$this->form_validation->set_rules('kodemk', 'Kode Matakuliah', 'required');
		$this->form_validation->set_rules('pjawab', 'Peminjam', 'required');
		$this->form_validation->set_rules('nruang', 'Nama Ruangan', 'required');
		$this->form_validation->set_rules('ja', 'Jam', 'required');
		$this->form_validation->set_rules('har', 'Hari', 'required');
		$this->form_validation->set_rules('set', 'Semester', 'required');
		$this->form_validation->set_rules('nd', 'Dosen', 'required');
		$this->form_validation->set_rules('tpem', 'Tanggal Pemakaian Ruangan', 'required');


		if ($this->form_validation->run() ==  false)
		{

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('proses/input', $data);
			$this->load->view('templates/footer');
		} else { 

			$insertdataPP = [
				'kode_tahun_akademik' => $this->input->post('ta'),
				'kode_mk' => $this->input->post('kodemk'),
				'kode_peminjam' => $this->input->post('pjawab'),
				'kode_ruangan' => $this->input->post('nruang'),
				'kode_jam' => $this->input->post('ja'),
				'kode_hari' => $this->input->post('har'),
				'kode_dosen' => $this->input->post('nd'),
				'kode_semester_tipe' => $this->input->post('set'),
				'kode_semester' => $this->input->post('smst'),
				'tgl_pr' => $this->input->post('tpem'),
				'create_at' => time(),
				'create_by' => $this->input->post('namauser')
			];

			// var_dump($insertdataPP);
			// die;

			$this->Proses_model->addpemakaian($insertdataPP);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
			redirect('input/pemakaian');
		}
	}

	public function pinputList()
	{
            // POST data dari view
		$postData = $this->input->post();

            // get data dari model
		$data = $this->Proses_model->getInputMaster($postData);

		echo json_encode($data);
	}

	public function dataMK($kode='')
	{
		$kode=$this->input->post('kode');

		$data=$this->Proses_model->getMK($kode);
		echo json_encode($data);

	}

	public function dataPJ($kode_p='')
	{
		$kode_p=$this->input->post('kode_p');

		$data=$this->Proses_model->getPJ($kode_p);
		echo json_encode($data);

	}

	public function dataJSE($kode='')
	{
		$kode=$this->input->post('kode');

		$data=$this->Proses_model->getJSE($kode);
		echo json_encode($data);

	}

	public function dataNR($kode='')
	{
		$kode=$this->input->post('kode');

		$data=$this->Proses_model->getNR($kode);
		echo json_encode($data);

	}

	public function pemakaiangetEdit($id_pemakaian='')
	{
		$id_pemakaian=$this->input->post('id_pemakaian');

		$data=$this->Proses_model->getPemakaianbyKode($id_pemakaian);
		echo json_encode($data);

	}

	public function pemakaiandelete()
	{
		$id_pemakaian=$this->input->post('id_pemakaian');
		$data=$this->Proses_model->dellP($id_pemakaian);
		echo json_encode($data); 
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
       // redirect('data/jam');
	}

	public function editPR()
	{
		$id_pemakaian = $this->input->post('id_pemakaian');
		$saveedipr = [
			'kode_mk' => $this->input->post('kode_mk'),
			'kode_peminjam' => $this->input->post('kode_peminjam'),
			'kode_ruangan' => $this->input->post('kode_ruangan'),
			'kode_jam' => $this->input->post('kode_jam'),
			'kode_hari' => $this->input->post('kode_hari'),
			'kode_dosen' => $this->input->post('kode_dosen'),
			'kode_semester_tipe' => $this->input->post('kode_semester_tipe'),
			'tgl_pr' => $this->input->post('tgl_pr'),
			'kode_tahun_akademik' => $this->input->post('kode_tahun_akademik'),
			'kode_semester' => $this->input->post('kode_semester'),
			'update_by' => $this->input->post('update_by'),
			'update_at' => time()
		];

		// var_dump($saveeditpr);
		// die;
		$data = $this->Proses_model->saveeditpru($id_pemakaian,$saveedipr);
		echo json_encode($data);
		$this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
	}
	
	// END CONTROLLER PROSES INPUT PEMAKAIAN

	// start Controller Master Peminjam
	public function peminjaman()
	{
		$data['title'] = 'Data Peminjam';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['TypeR'] = $this->Fasilitas_model->getTypeRuang()->result_array();

		$this->form_validation->set_rules('nppku', 'No Surat PPKU', 'required');
		$this->form_validation->set_rules('nop', 'No Surat Peminjaman', 'required');
		$this->form_validation->set_rules('keg', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('tsp', 'Tanggal Surat Peminjaman', 'required');
		$this->form_validation->set_rules('har', 'Hari', 'required');
		$this->form_validation->set_rules('tg', 'Tanggal Kegiatan', 'required');
		$this->form_validation->set_rules('typer', 'Nama Ruangan', 'required');
		$this->form_validation->set_rules('penj', 'Penanggung Jawab', 'required');
		
		if ($this->form_validation->run() ==  false)
		{

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('peminjam/index', $data);
			$this->load->view('templates/footer');
		} else { 

			$insertdataP = [
				'no_ppku' => $this->input->post('nppku'),
				'no_peminjam' => $this->input->post('nop'),
				'kegiatan' => $this->input->post('keg'),
				'tgl_surat_peminjaman' => $this->input->post('tsp'),
				'hari' => $this->input->post('har'),
				'tgl_kegiatan' => $this->input->post('tg'),
				'id_type_ruangan' => $this->input->post('typer'),
				'pj' => $this->input->post('penj')
			];
			// 
			$this->Fasilitas_model->addpeminjam($insertdataP);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
			redirect('input/peminjaman');
		}
	}

	public function peminjamList()
	{
            // POST data dari view
		$postData = $this->input->post();

            // get data dari model
		$data = $this->Fasilitas_model->getMasterPeminjam($postData);

		echo json_encode($data);

	}

	public function tagetPeminjam($kode_p='')
	{
		$kode_p=$this->input->post('kode_p');
		$data=$this->Fasilitas_model->getPeminjambyKode($kode_p);
		echo json_encode($data);  
	}

	public function peminjamdelete()
	{
		$kode_p=$this->input->post('kode_p');
		$data=$this->Fasilitas_model->dellPeminjam($kode_p);
		echo json_encode($data); 
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
	}

	public function editPeminjam()
	{
		$kode_p = $this->input->post('kode_p');
		$saveeditpem = [
			'no_ppku' => $this->input->post('no_ppku'),
			'no_peminjam' => $this->input->post('no_peminjam'),
			'kegiatan' => $this->input->post('kegiatan'),
			'tgl_surat_peminjaman' => $this->input->post('tgl_surat_peminjaman'),
			'hari' => $this->input->post('hari'),
			'tgl_kegiatan' => $this->input->post('tgl_kegiatan'),
			'id_type_ruangan' => $this->input->post('id_type_ruangan'),
			'pj' => $this->input->post('pj')
		];
		$data = $this->Fasilitas_model->saveeditpemilik($kode_p, $saveeditpem);
		echo json_encode($data);
		$this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
	}
    // end Controller Master Peminjam




}