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
    // end Controller Master Falsilitas

}