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

	

	// START CONTROLLER PROSES ALGORITMA GENETIK
	// keajaiban bermula disini
	public function algoritmagenetik()
	{ 
		$data['title'] = 'Proses Algoritma Genetika';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['smst'] = $this->Proses_model->getsemester()->result_array();
		$data['taka'] = $this->Proses_model->gettahunakademik()->result_array();
		$data['prod'] = $this->Proses_model->getprodi()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('algoritma/index', $data);
		$this->load->view('templates/footer');
	}

	public function algo()
	{
		$kode_semester=$this->input->post('semester');
		$ta=$this->input->post('tahun_akademik');
		$dat=$this->input->post('populasi');
		$crossOver = $this->input->post('crossover');
		$mutasi = $this->input->post('mutasi');
		$jumlah_generasi = $this->input->post('generasi');
		$pro = $this->input->post('prodi');

		// $data['pilihan']=$this->Proses_model->getMKWhereId($dat);
		if($pro == true){
			echo "benar";
		} else {
			echo "salah";
		}


	}

	// END CONTROLLER PROSES ALGORITMA GENETIK




}