<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Algoritma extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Data_model');
		$this->load->model('Nomor_model');
		$this->load->library('form_validation');
	}

	public function algoritmagenetic()
	{
		$data['title'] = 'Proses Algoritma Genetika';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('algoritma/index', $data);
		$this->load->view('templates/footer');
	}




}