<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Master_model');
        $this->load->library('form_validation');
 
    }

    public function barang()
    {
    	$data['title'] = 'Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['getAllM'] = $this->Master_model->getAllMaster();
        // $data['menu'] = $this->db->get('user_menu')->result_array();

        // $this->form_validation->set_rules('menu', 'Menu', 'required');

        // if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/index', $data);
            $this->load->view('templates/footer');
        // } else {
        //     $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
        //     redirect('menu');
        // }
    }

    public function barangList()
    {
    	// POST data dari view
    	$postData = $this->input->post();

    	// get data dari model
    	$data = $this->Master_model->getMaster($postData);

    	echo json_encode($data);
    	

    }

    // public function addBarang()
    // {
    // 	// $data['menu'] = $this->db->get('user_menu')->result_array();

    //     $this->form_validation->set_rules('merk', 'Merk', 'required|trim|min_length[3]');

    //     if ($this->form_validation->run() == false) {
    //         // $this->load->view('templates/header', $data);
    //         // $this->load->view('templates/sidebar', $data);
    //         // $this->load->view('templates/topbar', $data);
    //         // $this->load->view('master/index', $data);
    //         // $this->load->view('templates/footer');
    //         redirect('master/barang');
    //     } else {
    //         // $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
    //         redirect('master/barang');
    //     }
    // }

    public function add_barang()
    {
    	$data['title'] = 'Add Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['getAllJenisBarang'] = $this->Master_model->getAllJenisBarang();
        $data['getAllSatuan'] = $this->Master_model->getAllSatuan();

        // $data['getAllM'] = $this->Master_model->getAllMaster();
        $this->form_validation->set_rules('merk', 'Merk', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('jenisbarang', 'Jenis Barang', 'required|trim');
        $this->form_validation->set_rules('model', 'Model Barang', 'required|trim');
        $this->form_validation->set_rules('u_bar', 'Ukuran Barang', 'required|trim|numeric');
        $this->form_validation->set_rules('model', 'Model Barang', 'required|trim');
        $this->form_validation->set_rules('dimensi', 'Demensi Barang', 'required|trim');
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'required');
        $this->form_validation->set_rules('satuan1', 'Satuan Barang', 'required');

        if ($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/add-barang', $data);
        $this->load->view('templates/footer');
    	} else {

    		$upload_image = $_FILES['fileku'];
     //        var_dump($upload_image);
    	// die;
            
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/barang/';

                $this->load->library('upload', $config);
                if ( $this->upload->do_upload('fileku')) {                

                   
                    $files = $this->upload->data('file_name');
                    $uploadfile                 = [
                        
                        'image_master'          => $files,
                        'merk' 					=> htmlspecialchars($this->input->post('merk', true)),
		                'jenis' 				=> htmlspecialchars($this->input->post('jenisbarang', true)),
		                'model' 				=> htmlspecialchars($this->input->post('model', true)),
		                'ukuran_barang' 		=> htmlspecialchars($this->input->post('u_bar', true)).' '.($this->input->post('satuan', true)),
		                'dimensi' 				=> htmlspecialchars($this->input->post('dimensi', true)).' '.($this->input->post('satuan1', true)),
		                
		                'status_master' 		=> 1,
		                'by_created_master'		=> htmlspecialchars($this->input->post('us',true)),
		                
		                'date_created_master' 	=> time(),
		                'by_updated_master'		=> htmlspecialchars($this->input->post('us',true)),
		                
		                'date_update_master' 	=> time()
                    ];

                    } else {
                    
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('master/add_barang');
                }
            }


    		// echo "data ok";
    		
    		// $insertdata = [
      //           'merk' 			=> htmlspecialchars($this->input->post('merk', true)),
      //           'jenis' 		=> htmlspecialchars($this->input->post('jenisbarang', true)),
      //           'model' 		=> htmlspecialchars($this->input->post('model', true)),
      //           'ukuran_barang' => htmlspecialchars($this->input->post('u_bar', true)).' '.($this->input->post('satuan', true)),
      //           'dimensi' 		=> htmlspecialchars($this->input->post('dimensi', true)).' '.($this->input->post('satuan1', true)),
                
      //           'status_master' => 1,
                
      //           'date_created_master' => time(),
                
      //           'date_update_master' => time()
      //       ];
    	// var_dump($uploadfile);
    	// die;

    			$this->Master_model->addMasterBarang($uploadfile);
    	// $this->Admin_model->addDBProductionitem($insertdata);

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been Add..Please Check againt!</div>');
                        redirect('master/barang');
		}
    }


  public function edit_barang($idm)
  {
  	
  	$data['title'] = 'Barang';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

  	$data['title'] = 'Edit Barang';

  	$data['getAllJenisBarang'] = $this->Master_model->getAllJenisBarang();
    $data['getAllSatuan'] = $this->Master_model->getAllSatuan();
  	$data['brg'] = $this->Master_model->getMasterByIdm($idm);
  	

  	$this->load->view('templates/header', $data);
	$this->load->view('templates/sidebar', $data);
	$this->load->view('templates/topbar', $data);
    $this->load->view('master/edit-barang', $data);
    $this->load->view('templates/footer');
  }

  public function save_edit()
  {


  	$this->form_validation->set_rules('merk', 'Merk', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('jenisbarang', 'Jenis Barang', 'required|trim');
    $this->form_validation->set_rules('model', 'Model Barang', 'required|trim');
    $this->form_validation->set_rules('u_bar', 'Ukuran Barang', 'required|trim|numeric');
    $this->form_validation->set_rules('model', 'Model Barang', 'required|trim');
    $this->form_validation->set_rules('dimensi', 'Demensi Barang', 'required|trim');
    $this->form_validation->set_rules('satuan', 'Satuan Barang', 'required');
    $this->form_validation->set_rules('satuan1', 'Satuan Barang', 'required');

    $idm = $this->input->post('idm');
  	// var_dump($idms);
  	// die;
    if ($this->form_validation->run() == false)
    {
    	$data['title'] = 'Barang';
	    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

	  	$data['title'] = 'Edit Barang';
	  	
	  	$data['getAllJenisBarang'] = $this->Master_model->getAllJenisBarang();
	    $data['getAllSatuan'] = $this->Master_model->getAllSatuan();
	  	$data['brg'] = $this->db->get_where('master', ['idm' => $idm])->row_array();
	  	// $data['brg'] = $this->Master_model->getAllMaster('master',['idm'=>$idm]);

	  	$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
	    $this->load->view('master/edit-barang', $data);
	    $this->load->view('templates/footer');
    } else {

        // cek jika ada gambar yang akan diupload

        $editMaster = [
                        // 'image_master'          => $new_image,
                        'merk'                  => htmlspecialchars($this->input->post('merk', true)),
                        'jenis'                 => htmlspecialchars($this->input->post('jenisbarang', true)),
                        'model'                 => htmlspecialchars($this->input->post('model', true)),
                        'ukuran_barang'         => htmlspecialchars($this->input->post('u_bar', true)).' '.($this->input->post('satuan', true)),
                        'dimensi'               => htmlspecialchars($this->input->post('dimensi', true)).' '.($this->input->post('satuan1', true)),
                        
                        // 'status_master'         => 1,
                        // 'by_created_master'     => htmlspecialchars($this->input->post('us',true)),
                        
                        // 'date_created_master'   => time(),
                        'by_updated_master'     => htmlspecialchars($this->input->post('us',true)),
                        
                        'date_update_master'    => time()
                    ];


        // $editMaster = [
        //                 'merk'                  => htmlspecialchars($this->input->post('merk', true)),
        //                 'jenis'                 => htmlspecialchars($this->input->post('jenisbarang', true)),
        //                 'model'                 => htmlspecialchars($this->input->post('model', true)),
        //                 'ukuran_barang'         => htmlspecialchars($this->input->post('u_bar', true)).' '.($this->input->post('satuan', true)),
        //                 'dimensi'               => htmlspecialchars($this->input->post('dimensi', true)).' '.($this->input->post('satuan1', true)),
                        
        //                 // 'status_master'         => 1,
        //                 // 'by_created_master'     => htmlspecialchars($this->input->post('us',true)),
                        
        //                 // 'date_created_master'   => time(),
        //                 'by_updated_master'     => htmlspecialchars($this->input->post('us',true)),
                        
        //                 'date_update_master'    => time()
        //             ];

            $upload_image = $_FILES['fileku'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/barang/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fileku')) {
                    $old_image = $data['master']['image_master'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/barang/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image_master', $new_image);



                } 
                // else {
                    
                //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    
                //     redirect('master/barang');
                // }
            }

            

    	// echo "ok";
     //    var_dump($editMaster);
     //    die();
        $idm = $this->input->post('idm');
        // $this->db->set('name', $name);
        $this->db->where('idm', $idm);
        // $this->db->update('master/barang');
        $this->db->update('master', $editMaster);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data has been updated!</div>');
            redirect('master/barang');


    }
  } 

  public function dell_barang($idm)
  {
        $this->Master_model->dellDBMaster($idm);
// tinggal hapus file di folder
        // if( $this->Admin_model->dellDBPublicItem($idb) > 0 ){
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your data has been delete..</div>');
                redirect('master/barang');
  }

  



}