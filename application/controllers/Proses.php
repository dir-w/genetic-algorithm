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

		$kode_semester_tipe=$this->input->post('semester');
		$ta=$this->input->post('tahun_akademik');
		$dat=$this->input->post('populasi');
		$crossOver = $this->input->post('crossover'); 
		$mutasi = $this->input->post('mutasi');
		$jumlah_generasi = $this->input->post('generasi');
		$pro = $this->input->post('prodi');


		$this->form_validation->set_rules('populasi', 'Populasi', 'required');
		$this->form_validation->set_rules('semester', 'Semester', 'required');
		$this->form_validation->set_rules('tahun_akademik', 'Tahun Akademik', 'required');
		$this->form_validation->set_rules('crossover', 'Nilai Crossover', 'required');
		$this->form_validation->set_rules('generasi', 'Nilai Generasi', 'required');
		$this->form_validation->set_rules('mutasi', 'Nilai Mutasi', 'required');
		if($this->form_validation->run() == true){
			
			// echo "benar";
			if($pro==true){
				$ru_data = $this->db->query("SELECT a.id_pemakaian "
					. "FROM pemakaian_ruangan a "
					. "LEFT JOIN semester b ON a.kode_semester = b.kode "
					. "LEFT JOIN tahun_akademik c "
					. "ON a.kode_tahun_akademik = c.kode " 
					. "LEFT JOIN matapelajaran d ON a.kode_mk = d.kode "
					. "WHERE a.kode_tahun_akademik='$ta' "
					. "AND a.kode_semester_tipe ='$kode_semester_tipe' "
					. "AND d.kode_prodi='$pro'");
			}else{
				$ru_data = $this->db->query("SELECT a.id_pemakaian "
					. "FROM pemakaian_ruangan a "
					. "LEFT JOIN semester b ON a.kode_semester = b.kode "
					. "LEFT JOIN tahun_akademik c "
					. "ON a.kode_tahun_akademik = c.kode " 
					. "LEFT JOIN matapelajaran d ON a.kode_mk = d.kode "
					. "WHERE a.kode_tahun_akademik='$ta' "
					. "AND a.kode_semester_tipe ='$kode_semester_tipe'");
			}
			// var_dump($ru_data);
			// die;
			$tas = $this->db->get_where('tahun_akademik', ['kode' => $ta])->row_array();
			$ks = $this->db->get_where('semester_tipe', ['kode' => $kode_semester_tipe])->row_array();
			var_dump($ks);
				// die;
			if($ru_data->num_rows() == 0){
				// echo "kosong";

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Data dengan Semester : <b>'.$ks['tipe_semester'].'</b> dan Tahun Akademik : <b>'.$tas['tahun'].'</b><br>Data yang tampil dibawah adalah data dari proses sebelumnya</div>');
				// redirect('proses/algoritmagenetik');
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('algoritma/index', $data);
				$this->load->view('templates/footer');
			}else{

			}
		}else{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('algoritma/index', $data);
			$this->load->view('templates/footer');
		}
	}


	private function algo()
	{



		if($this->form_validation->run() == false){
			$kode_semester_tipe=$this->input->post('semester');
			$ta=$this->input->post('tahun_akademik');
			$dat=$this->input->post('populasi');
			// $crossOver = $this->input->post('crossover');
			// $mutasi = $this->input->post('mutasi');
			// $jumlah_generasi = $this->input->post('generasi');
			$pro = $this->input->post('prodi');
			$data['prod'] = $this->Proses_model->getprodi()->result_array();
		// $data['pro'] = $pro;
		// var_dump($pro);
		// die;
		// $data['pilihan']=$this->Proses_model->getMKWhereId($dat);

			if($pro==true){
				$ru_data = $this->db->query("SELECT a.id_pemakaian "
					. "FROM pemakaian_ruangan a "
					. "LEFT JOIN semester b ON a.kode_semester = b.kode "
					. "LEFT JOIN tahun_akademik c "
					. "ON a.kode_tahun_akademik = c.kode " 
					. "LEFT JOIN matapelajaran d ON a.kode_mk = d.kode "
					. "WHERE a.kode_tahun_akademik='$ta' "
					. "AND a.kode_semester_tipe ='$kode_semester_tipe' "
					. "AND d.kode_prodi='$pro'");
			// echo "true";
			// $ru_data = $this->db->query("SELECT a.id_pemakaian FROM pemakaian_ruangan a LEFT JOIN semester b ON a.kode_semester = b.kode LEFT JOIN tahun_akademik c ON a.kode_tahun_akademik = c.kode LEFT JOIN matapelajaran d ON a.kode_mk = d.kode WHERE a.kode_tahun_akademik='$ta' AND a.kode_semester_tipe ='$kode_semester_tipe' AND d.kode_prodi='$pro'");
			// $ru_data = $this->db->query("SELECT a.id_pemakaian"
			// 	. "FROM pemakaian_ruangan a"
			// 	. "LEFT JOIN semester b"
			// 	. "ON a.kode_semester = b.kode"
			// 	. "LEFT JOIN tahun_akademik c"
			// 	. "ON a.kode_tahun_akademik = c.kode"
			// 	. "LEFT JOIN matapelajaran d"
			// 	. "ON a.kode_mk = d.kode"
			// 	. "WHERE a.kode_tahun_akademik='$ta'"
			// 	. "AND a.kode_semester_tipe ='$kode_semester_tipe'"
			// 	. "AND d.kode_prodi='$pro'");

			} else {
				$ru_data = $this->db->query("SELECT a.id_pemakaian "
					. "FROM pemakaian_ruangan a "
					. "LEFT JOIN semester b ON a.kode_semester = b.kode "
					. "LEFT JOIN tahun_akademik c "
					. "ON a.kode_tahun_akademik = c.kode " 
					. "LEFT JOIN matapelajaran d ON a.kode_mk = d.kode "
					. "WHERE a.kode_tahun_akademik='$ta' "
					. "AND a.kode_semester_tipe ='$kode_semester_tipe'");
			// echo "false";
			// $ru_data = $this->db->query("SELECT a.id_pemakaian FROM pemakaian_ruangan a LEFT JOIN semester b ON a.kode_semester = b.kode LEFT JOIN tahun_akademik c ON a.kode_tahun_akademik = c.kode LEFT JOIN matapelajaran d ON a.kode_mk = d.kode WHERE a.kode_tahun_akademik='8' AND a.kode_semester_tipe ='$pro'");
			// $ru_data = $this->db->query("SELECT a.id_pemakaian "
			// 	. "FROM pemakaian_ruangan a "
			// 	. "LEFT JOIN semester b "
			// 	. "ON a.kode_semester = b.kode "
			// 	. "LEFT JOIN tahun_akademik c "
			// 	. "ON a.kode_tahun_akademik = c.kode "
			// 	. "LEFT JOIN matapelajaran d "
			// 	. "ON a.kode_mk = d.kode"
			// 	. "WHERE a.kode_tahun_akademik='$ta' "
			// 	. "AND a.kode_semester_tipe ='$kode_semester_tipe'");

			}
		// $n = count($ru_data);
		// var_dump($n);
		// die;

			if($ru_data->num_rows() == 0){
			// echo "kosong";
				$data['msg'] = 'Tidak Ada Data dengan Semester dan Tahun Akademik ini <br>Data yang tampil dibawah adalah data dari proses sebelumnya';
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Ada Data dengan Semester dan Tahun Akademik ini!..<br>Data yang tampil dibawah adalah data dari proses sebelumnya</div>');
				redirect('proses/algoritmagenetik');
			}else{
			// $rn = $this->db->query("SELECT a.id_pemakaian "
			// 	. "FROM pemakaian_ruangan a "
			// 	. "LEFT JOIN semester b ON a.kode_semester = b.kode "
			// 	. "LEFT JOIN tahun_akademik c "
			// 	. "ON a.kode_tahun_akademik = c.kode " 
			// 	. "LEFT JOIN matapelajaran d ON a.kode_mk = d.kode "
			// 	. "WHERE a.kode_tahun_akademik='$ta' "
			// 	. "AND a.kode_semester_tipe ='$kode_semester_tipe' "
			// 	. "AND d.kode_prodi='$pro'");
			// $n = count($ru_data);
			// $n = 0;

			// if($ru_data->num_rows() % 2 == 0 ){
			// 	$jumlah_populasi =$ru_data->num_rows();
			// }
			// else{
			// 	$jumlah_populasi =$ru_data->num_rows() + 1;
			// }
				$j = $ru_data->num_rows();
			// $banyak_populasi= intval($ru_data->num_rows()/2);

				var_dump($j);
				die;


			}


		}
	}

	// END CONTROLLER PROSES ALGORITMA GENETIK




}