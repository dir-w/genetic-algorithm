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

		$data['matakuliah'] = $this->Proses_model->getMatakuliah()->result_array();
		$data['pemin'] = $this->Proses_model->getP()->result_array();
		$data['hari'] = $this->Proses_model->getH()->result_array();
		$data['ruangan'] = $this->Proses_model->getR()->result_array();
		$data['semestertipe'] = $this->Proses_model->getSE()->result_array();
		$data['jam'] = $this->Proses_model->getJ()->result_array();
		$data['dosen'] = $this->Proses_model->getD()->result_array();
		$this->form_validation->set_rules('nf', 'Nama Fasilitas', 'required');
		
		if ($this->form_validation->run() ==  false)
		{

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('proses/input', $data);
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

	
	// END CONTROLLER PROSES INPUT PEMAKAIAN

}