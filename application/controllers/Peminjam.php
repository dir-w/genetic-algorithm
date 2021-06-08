<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjam extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Fasilitas_model');
        // $this->load->model('Nomor_model');
		$this->load->library('form_validation');
	}

    // Start Controller Master Fasilitas
	public function fasilitas()
	{
		$data['title'] = 'Master Fasilitas';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nf', 'Nama Fasilitas', 'required');
		
		if ($this->form_validation->run() ==  false)
		{

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('peminjam/fasilitas', $data);
			$this->load->view('templates/footer');
		} else { 

			$insertdataF = [
				'nama_fasilitas' => $this->input->post('nf')
			];

			$this->Fasilitas_model->addfasilitas($insertdataF);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
			redirect('peminjam/fasilitas');
		}
	}

	public function fasilitasList()
	{
            // POST data dari view
		$postData = $this->input->post();

            // get data dari model
		$data = $this->Fasilitas_model->getMasterFasilitas($postData);

		echo json_encode($data);

	}

	public function tagetFasilitas($kode_f='')
	{
		$kode_f=$this->input->post('kode_f');
		$data=$this->Fasilitas_model->getFasilitasbyKode($kode_f);
		echo json_encode($data);  
	}

	public function fasilitasdelete()
	{
		$kode_f=$this->input->post('kode_f');
		$data=$this->Fasilitas_model->dellFasilitas($kode_f);
		echo json_encode($data); 
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data has been delete..</div>');
	}

	public function editFasilitas()
	{
		$kode_f = $this->input->post('kode_f');
		$saveeditf = [
			'nama_fasilitas' => $this->input->post('nama_fasilitas')
		];
		$data = $this->Fasilitas_model->saveeditfasilitas($kode_f, $saveeditf);

		
		echo json_encode($data);
		$this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
	}
    // end Controller Master Falsilitas

    // start Controller Master Peminjam
	public function peminjaman()
	{
		$data['title'] = 'Master Peminjam';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['fasi'] = $this->Fasilitas_model->getFasilitas()->result_array();

		$this->form_validation->set_rules('nppku', 'No Surat PPKU', 'required');
		$this->form_validation->set_rules('nop', 'No Surat Peminjaman', 'required');
		$this->form_validation->set_rules('keg', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('tsp', 'Tanggal Surat Peminjaman', 'required');
		$this->form_validation->set_rules('har', 'Hari', 'required');
		$this->form_validation->set_rules('tg', 'Tanggal Kegiatan', 'required');
		$this->form_validation->set_rules('fas', 'Nama Fasilitas', 'required');
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
				'id_fasilitas' => $this->input->post('fas'),
				'pj' => $this->input->post('penj')
			];
			// 
			$this->Fasilitas_model->addpeminjam($insertdataP);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
			redirect('peminjam/peminjaman');
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
			'id_fasilitas' => $this->input->post('id_fasilitas'),
			'pj' => $this->input->post('pj')
		];
		$data = $this->Fasilitas_model->saveeditpemilik($kode_p, $saveeditpem);
		echo json_encode($data);
		$this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">Data has been update..</div>');
	}
    // end Controller Master Peminjam

}