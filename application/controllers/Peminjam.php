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

}