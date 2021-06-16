<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proses extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Proses_model');
        // $this->load->model('Nomor_model');
		$this->load->library('form_validation');
	}

	// START CONTROLLER PROSES INPUT PEMAKAIAN
	public function pemakaian()
	{
		$data['title'] = 'Input Data Pemakaian';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$namauser = $data;
		// $idh = $this->Nomor_model->getNohari();

		$data['matakuliah'] = $this->Proses_model->getMatakuliah()->result_array();
		$data['pemin'] = $this->Proses_model->getP()->result_array();
		$data['hari'] = $this->Proses_model->getH()->result_array();
		$data['ruangan'] = $this->Proses_model->getR()->result_array();
		$data['semestertipe'] = $this->Proses_model->getSE()->result_array();
		$data['jam'] = $this->Proses_model->getJ()->result_array();
		$data['dosen'] = $this->Proses_model->getD()->result_array();
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
				'kode_mk' => $this->input->post('kodemk'),
				'kode_peminjam' => $this->input->post('pjawab'),
				'kode_ruangan' => $this->input->post('nruang'),
				'kode_jam' => $this->input->post('ja'),
				'kode_hari' => $this->input->post('har'),
				'kode_dosen' => $this->input->post('nd'),
				'kode_semester' => $this->input->post('set'),
				'tgl_pr' => $this->input->post('tpem'),
				'create_at' => time(),
				'create_by' => $this->input->post('namauser')
			];

			// var_dump($insertdataPP);
			// die;

			$this->Proses_model->addpemakaian($insertdataPP);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
			redirect('proses/pemakaian');
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
			'kode_semester' => $this->input->post('kode_semester'),
			'tgl_pr' => $this->input->post('tgl_pr'),
			'update_by' => $this->input->post('update_by'),
			'update_at' => time()
		];

		// var_dump($saveeditpr);
		// die;
		$data = $this->Proses_model->saveeditpru($id_pemakaian,$saveedipr);
		echo json_encode($data);
		$this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
	}

	// http://localhost:82/genetic-algorithm/proses/pemakaian?id_pemakaian=1&nama_user=wend&kode_mk=1&p_jawab=1&n_ruang=1&n_d=1&semester=1&nama_mk=Pendidikan+Agama+Islam&kegiatan=kjlkj&kapasitas=1&hari=1&jam=1

	
	// END CONTROLLER PROSES INPUT PEMAKAIAN

}