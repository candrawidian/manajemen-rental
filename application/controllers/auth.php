<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');

	}
	public function index()
	{	
		if($this->session->userdata('email')){
			redirect('user');
		}

		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run()==false){
		$data['title'] = 'Login Page';
		$this->load->view('templates/auth_header',$data);
		$this->load->view('auth/login');
		$this->load->view('templates/auth_footer');
	}else{
		//validasi success
		$this->_login();
	}
	}

	private function _login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user',['email'=>$email])->row_array();
		// jika user aktif
		if($user)
		{
			//user ada
			if($user['is_active']==1){
			// cek password
			if(password_verify($password, $user['password']))
			{	
				$data = [
					'email' => $user['email'],
					'role_id' => $user['role_id']

				];
				$this->session->set_userdata($data);
				if ($user['role_id']==1) {
					redirect('admin');
				}elseif($user['role_id']==3){
					redirect('finance');
				redirect('user');
					}
				else{

				redirect('user');
					}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password yang anda masukkan salah!</div>');
		redirect('auth');

			}

			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email belum diaktivasi!</div>');
		redirect('auth');

			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email belum terdaftar</div>');
		redirect('auth');
		}

	}

	public function registration()
	{	
		if($this->session->userdata('email')){
			redirect('user');
		}

		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|is_unique[user.email]',[
				'is_unique'=>'Email sudah digunakan'

		]);
		$this->form_validation->set_rules('password1','Password','required|trim|min_length[8]|matches[password2]',[
				'matches'=>'Passwor tidak sama!',
				'min_length'=>'Password terlalu pendek'

		]);
		$this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');



		if($this->form_validation->run()==false){
		$data['title'] = 'Momototoy Operational';
		$this->load->view('templates/auth_header', $data);
		$this->load->view('auth/registration');
		$this->load->view('templates/auth_footer');
	}else{
		$data=[
			'name'=>htmlspecialchars($this->input->post('name','true')),
			'email'=>htmlspecialchars($this->input->post('email','true')),
			'image'=>'default.jpg',
			'password'=>password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
			'role_id'=>2,
			'is_active'=>1,
			'date_create'=>time()

		];
		$this->db->insert('user',$data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Akun anda berhasil dibuat. Silahkan Login!</div>');
		redirect('auth');

	}
}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Anda baru saja keluar!</div>');
		redirect('auth');

	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}

}