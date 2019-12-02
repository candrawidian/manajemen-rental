<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			is_logged_in();
			$this->load->model('keuangan_model');
			}

	public function index()
	{
		$data['title'] = 'Finance';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		
		$akhir = $this->input->post('tanggal_akhir');
		$awal = $this->input->post('tanggal_awal');

		if($akhir!=''&&$awal!=''){
			$data['keuangan'] = $this->keuangan_model->ambilfilter($awal,$akhir);
		
		}else{

		$data['keuangan'] = $this->keuangan_model->ambildata();
		}

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('finance/index',$data);
		$this->load->view('templates/footer',$data);

	}

	public function ambildata(){

		$jios['jios'] = $this->db->get('keuangan')->result_array();
		echo json_encode($jios['jios']);

	}

	public function tambahdata()
	{
		$data['title'] = 'Tambah Data';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		
		$data['keuangan'] = $this->keuangan_model->ambildata();

		
		$this->form_validation->set_rules('judul','Judul','required');
		$this->form_validation->set_rules('tanggal','tanggal','required');
		$this->form_validation->set_rules('status','Status','required');
		$this->form_validation->set_rules('nominal','Nominal','required');

		if ($this->form_validation->run()==false)
		{
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('finance/tambahdata',$data);
		$this->load->view('templates/footer',$data);
	}else{
		$data = array(
			'judul' => $this->input->post('judul'),
			'tanggal' => $this->input->post('tanggal'),
			'status' => $this->input->post('status'),
			'nominal' => $this->input->post('nominal'),


		 );

		$this->keuangan_model->keuangan($data);
		//Loading View
		
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil ditambahkan</div>');
		//Loading View
		redirect('finance/tambahdata');
	}

	}

	public function ubahdata()
	{
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		
		$data['keuangan'] = $this->keuangan_model->ambildata();

		
		$this->form_validation->set_rules('judul','Judul','required');
		$this->form_validation->set_rules('tanggal','tanggal','required');
		$this->form_validation->set_rules('status','Status','required');
		$this->form_validation->set_rules('nominal','Nominal','required');

		if ($this->form_validation->run()==false)
		{
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('finance/index',$data);
		$this->load->view('templates/footer',$data);
	}else{

		$this->keuangan_model->ubahdata();
		//Loading View
		
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil dirubah</div>');
		//Loading View
		redirect('finance');
	}

	}

	public function hapusdata()
	{
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$id = $this->input->post('id');
		$this->keuangan_model->hapusdata($id);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil dihapus</div>');
			//Loading View
		redirect('finance/tambahdata');
	}

	public function print()
	{
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$awal =  $this->uri->segment(3);
		$akhir = $this->uri->segment(4);

		if($awal!=''&&$akhir!=''){
		$data['masuk'] = $this->keuangan_model->ambilmasuk($awal,$akhir);
		$data['keluar'] = $this->keuangan_model->ambilkeluar($awal,$akhir);
		$this->load->view('finance/print',$data);
		}else{
			$data['masuk'] = $this->keuangan_model->ambildatamasuk();
			$data['keluar'] = $this->keuangan_model->ambildatakeluar();
			$this->load->view('finance/print',$data);
		}
		

	}
}