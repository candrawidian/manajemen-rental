<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			is_logged_in();
			$this->load->model('jadwal_model');
			$this->load->model('karyawan_model');

		}

	public function index()
	{	
		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer',$data);

	}

	public function edit()
	{	
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name','Full Name','required');
		if ($this->form_validation->run() == false){
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/edit',$data);
		$this->load->view('templates/footer',$data);
	}else{
		$name = $this->input->post('name');
		$email = $this->input->post('email'); 

		//cek jika ada gambar yang akan upload
		$upload_image = $_FILES['image']['name'];

		if($upload_image){
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/profile/';

			$this->load->library('upload',$config);

			if($this->upload->do_upload('image')){

				$old_image = $data['user']['image'];
				if($old_image != 'default.jpg'){
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}
				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);
			}else{
				echo $this->upload->dispay_erors();
			}
			
		}


		$this->db->set('name',$name);
		$this->db->where('email',$email);
		$this->db->update('user');

		$this->db->set('nama', $name);
        $this->db->set('email', $email);
        $this->db->set('image', $new_image);
       
         $this->db->where('email', $email);
         $this->db->update('karyawan');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Profile anda berhasil dirubah</div>');
		redirect('user');


	}
	}

	public function pengiriman()
	{
		$data['title'] = 'Pengiriman';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$data['jadwal'] = $this->db->get('jadwal')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/pengiriman',$data);
		$this->load->view('templates/footer',$data);

	}

	public function userpengiriman()
	{
		$data['title'] = 'Pengiriman';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$data['produk'] = $this->db->get('produk')->result_array();

		$j=$data['user']['name'];
		$i=$data['user']['role_id'];
		
		if ($i > 1 ) {
				$data['jadwal'] = $this->db->get_where('jadwal',['Personil' => $j])->result_array();		
			
		}else{
				$data['jadwal'] = $this->db->get_where('jadwal')->result_array();
				

		}

			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/userpengiriman',$data);
			$this->load->view('templates/footer',$data);

	}
 

	public function tambahgambar()
	{	
		$data['jadwal'] = $this->db->get('jadwal')->row_array();
		
		$noRFO = $this->input->post('noRFO');

		$Statuse = $this->input->post('Statuse');

		if($Statuse == 0){

		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']     = '2048';
		$config['upload_path'] = './assets/img/jadwal/';

		$this->load->library('upload',$config);

		if ( ! $this->upload->do_upload('image1'))
                {
                        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Gambar ke-1 yang anda masukkan kebesaran/ bukan gambar</div>');
				redirect('user/userpengiriman');
                }
                else
                {
                        $new_image1 = $this->upload->data('file_name');;
                        $this->db->set('image1', $new_image1);
                        
                }
        if ( ! $this->upload->do_upload('image2'))
                {
                        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Gambar ke-2 yang anda masukkan kebesaran/ bukan gambar</div>');
				redirect('user/userpengiriman');
                }
                else
                {
                        $new_image2 = $this->upload->data('file_name');;
                        $this->db->set('image2', $new_image2);
                        
                }
			
		if ( ! $this->upload->do_upload('image3'))
                {
                        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Gambar ke-3 yang anda masukkan kebesaran/ bukan gambar</div>');
				redirect('user/userpengiriman');
                }
                else
                {
                        $new_image3 = $this->upload->data('file_name');;
                        $this->db->set('image3', $new_image3);
                        
                }
			
			if ( ! $this->upload->do_upload('image4'))
                {
                        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Gambar ke-4 yang anda masukkan kebesaran/ bukan gambar</div>');
				redirect('user/userpengiriman');
                }
                else
                {
                        $new_image4 = $this->upload->data('file_name');;
                        $this->db->set('image4', $new_image4);
                        
                }				
				$wektu = time();
				$this->db->set('Statuse', 1);
				$this->db->set('wektu', $wektu);
			}else{
				$this->db->set('Statuse', 2);
				$wektu2 = time();
				$this->db->set('wektu2',$wektu2);
			}								
				$this->db->where('noRFO',$noRFO);
				$this->db->update('jadwal');
						
				if($Statuse == 0){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Gambar anda berhasil diupload</div>');
				redirect('user/userpengiriman');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Okay Sipp, Unit Aman dan sudah dikantor</div>');
				redirect('user/userpengiriman');
			}
					
	}

	public function loaddata()
	{

		$data['jadwal'] = $this->db->get('jadwal')->result_array();
		echo json_encode($data);	
			
	}

	public function calendar()
	{
		$data['title'] = 'Pengiriman';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();
		if(!isset($_POST["noRFO"])){
			$this->load->view('user/calendar',$data);
		}else{
		
		$noRFO = $this->input->post('noRFO');
		$NamaPemesan = $this->input->post('NamaPemesan');
		$EmailEO = $this->input->post('EmailEO');
		$Event = $this->input->post('Event');
		$Orderan = $this->input->post('Orderan');
		$Personil = $this->input->post('Personil');
		$NoTlp = $this->input->post('NoTlp');
		$JumlahUnit = $this->input->post('JumlahUnit');
		$LamaSewa = $this->input->post('LamaSewa');
		$TanggalSewa = $this->input->post('TanggalSewa');
		$TanggalAntar = $this->input->post('TanggalAntar');

		$data = [

			'noRFO' => $noRFO,
			'NamaPemesan' => $NamaPemesan,
			'EmailEO' => $EmailEO,
			'Event' => $Event,
			'Orderan' => $Orderan,
			'Personil' => $Personil,
			'NoTlp' => $NoTlp,
			'JumlahUnit' => $JumlahUnit,
			'LamaSewa' => $LamaSewa,
			'TanggalAntar' => $TanggalAntar,
			'TanggalSewa' => $TanggalSewa
		];

		$this->jadwal_model->jadwal($data);
	}
	}
	
	
}