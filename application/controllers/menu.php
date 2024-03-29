<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			is_logged_in();
		}

	public function index()
	
	{	
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu','menu','required');

		if ($this->form_validation->run()==false)
		{
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('menu/index',$data);
		$this->load->view('templates/footer',$data);
		}else{
			$this->db->insert('user_menu',['menu'=>$this->input->post('menu')]);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Menu Berhasil ditambahkan</div>');
		redirect('menu');

		}

	}

	public function submenu()
	{
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();
		$this->load->model('menu_model','menu');

		$data['submenu']=$this->menu->getsubmenu();
		$data['menu']=$this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title','title','required');
		$this->form_validation->set_rules('menu_id','menu_id','required');
		$this->form_validation->set_rules('url','url','required');
		$this->form_validation->set_rules('icon','icon','required');
		

		if ($this->form_validation->run()==false)
		{

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('menu/submenu',$data);
		$this->load->view('templates/footer',$data);
		}else 
		{
			$data = 
			[
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Sub Menu Berhasil ditambahkan</div>');
		redirect('menu/submenu');
		}
	}

	public function editmenu()
	{	$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();
		$this->load->model('menu_model','menu');

		$data['submenu']=$this->menu->getsubmenu();
		$data['menu']=$this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title','title','required');
		$this->form_validation->set_rules('menu_id','menu_id','required');
		$this->form_validation->set_rules('url','url','required');
		$this->form_validation->set_rules('icon','icon','required');
		

		if ($this->form_validation->run()==false)
		{

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('menu/submenu',$data);
		$this->load->view('templates/footer',$data);
		}else 
		{	
			$this->menu->editmenu();
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Sub Menu Berhasil dirubah</div>');
		redirect('menu/submenu');
		}
	}

}