<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			is_logged_in();
			$this->load->model('jadwal_model');
			$this->load->model('karyawan_model');
			$this->load->model('produk_model');
			}

	public function index()
	{	

		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$this->db->select('SUM(TotalHarga) as total');
		$this->db->from('jadwal');
		$data['TotalHarga'] = $this->db->get()->row()->total;

		$data['jml'] = $this->db->count_all('jadwal');
				
		$data['produk'] = $this->db->get('produk')->result_array();
		$data['data']=$this->jadwal_model->hasil();
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/footer',$data);

	}

	public function produk()
	{	
		$data['title'] = 'Produk';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$data['produk'] = $this->db->get('produk')->result_array();

		$this->load->library('form_validation');

		$this->form_validation->set_rules('JumlahUnit','Jumlah Unit','required|greater_than[1]');
		$this->form_validation->set_rules('namaProduk','Nama Produk','required');
		$this->form_validation->set_rules('HargaPerUnit','Harga Per Unit','required');

		if ($this->form_validation->run()==false)
		{

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/produk',$data);
		$this->load->view('templates/footer',$data);

		}else{

		$namaProduk = $this->input->post('namaProduk');
		$HargaPerUnit = $this->input->post('HargaPerUnit');
		$JumlahUnit = $this->input->post('JumlahUnit');

		$data = [
			'namaProduk' => $namaProduk,
			'HargaPerUnit' => $HargaPerUnit,
			'JumlahUnit' => $JumlahUnit
		];
		
		$this->produk_model->tambahproduk($data);	

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil ditambahkan</div>');
		//Loading View
		redirect('admin/produk');
		}
		
	}

	public function editproduk()
	{	
		$this->form_validation->set_rules('namaProdukedit','nama Produk','required');
		$this->form_validation->set_rules('HargaPerUnitedit','Harga Per Unit','required');
		$this->form_validation->set_rules('JumlahUnitedit','Jumlah Unit','required|greater_than[1]');
		if ($this->form_validation->run()==false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Gagal diubah</div>');
		//Loading View
		redirect('admin/produk');

		}else{

			$this->produk_model->editproduk();
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil diubah</div>');
		//Loading View
		redirect('admin/produk');	
		
		}
	}


	public function hapusproduk()
	{	
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$id = $this->uri->segment(3);
		$this->produk_model->hapusproduk($id);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil dihapus</div>');
			//Loading View
		redirect('admin/produk');
				
	}
	
			public function role()
	{	

		$data['title'] = 'Access';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/role',$data);
		$this->load->view('templates/footer',$data);

	}
		public function roleAccess($role_id)
	{	

		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role',['id'=>$role_id])->row_array();

		$this->db->where('id !=',1);

		$data['menu'] = $this->db->get('user_menu')->result_array();
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/role-access',$data);
		$this->load->view('templates/footer',$data);

	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu',$data);

		if($result->num_rows()<1){

			$this->db->insert('user_access_menu',$data);
		}else{
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Access Berhasil Dirubah!</div>');
		

	}

	public function jadwal()
	{	
		$data['title'] = 'Tambah Jadwal';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();
		
		$this->load->library('form_validation');

		$data['ambilproduk'] = $this->produk_model->ambilproduk();


		$this->form_validation->set_rules('noRFO','no.RFO','required');
		$this->form_validation->set_rules('noSJ','no.SJ','required');
		$this->form_validation->set_rules('NamaPemesan','Nama Pemesan','required');
		$this->form_validation->set_rules('NoTlp','No.Tlp','required');
		$this->form_validation->set_rules('EmailEO','Email EO','required');
		$this->form_validation->set_rules('NamaEO','Nama EO','required');
		$this->form_validation->set_rules('AlamatWO','Alamat WO','required');
		$this->form_validation->set_rules('Orderan','Orderan','required');
		$this->form_validation->set_rules('JumlahUnit','Jumlah Unit','required');
		$this->form_validation->set_rules('TanggalSewa','Tanggal Sewa','required');
		$this->form_validation->set_rules('LamaSewa','Lama Sewa','required');
		$this->form_validation->set_rules('TanggalAntar','Tanggal Antar','required');
		$this->form_validation->set_rules('Venue','Venue','required');
		$this->form_validation->set_rules('AlamatVenue','Alamat Venue','required');
		$this->form_validation->set_rules('AlamatAntar','Alamat Antar','required');
		$this->form_validation->set_rules('HargaPerUnit','Harga Per Unit','required');
		$this->form_validation->set_rules('TotalHarga','Total Harga','required');
		$this->form_validation->set_rules('BiayaKirim','Biaya Kirim','required');
		$this->form_validation->set_rules('Transportasi','Transportasi','required');
		$this->form_validation->set_rules('TotalDibayar','Total Dibayar','required');
		$this->form_validation->set_rules('Personil','Personil','required');

			
		if ($this->form_validation->run()==false)
		{
				
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/jadwal',$data);
		$this->load->view('templates/footer',$data);
		}else{
		 $data = [
			'noRFO'=>htmlspecialchars($this->input->post('noRFO','true')),
			'noSJ'=>htmlspecialchars($this->input->post('noSJ','true')),
			'NamaPemesan'=>htmlspecialchars($this->input->post('NamaPemesan','true')),
			'NoTlp'=>htmlspecialchars($this->input->post('NoTlp','true')),
			'EmailEO'=>htmlspecialchars($this->input->post('EmailEO','true')),
			'NamaEO'=>htmlspecialchars($this->input->post('NamaEO','true')),
			'AlamatWO'=>htmlspecialchars($this->input->post('AlamatWO','true')),
			'Orderan'=>htmlspecialchars($this->input->post('Orderan','true')),
			'JumlahUnit'=>htmlspecialchars($this->input->post('JumlahUnit','true')),
			'TanggalSewa'=>htmlspecialchars($this->input->post('TanggalSewa','true')),
			'LamaSewa'=>htmlspecialchars($this->input->post('LamaSewa','true')),
			'TanggalAntar'=>htmlspecialchars($this->input->post('TanggalAntar','true')),
			'Venue'=>htmlspecialchars($this->input->post('Venue','true')),
			'AlamatVenue'=>htmlspecialchars($this->input->post('AlamatVenue','true')),
			'AlamatAntar'=>htmlspecialchars($this->input->post('AlamatAntar','true')),
			'HargaPerUnit'=>htmlspecialchars($this->input->post('HargaPerUnit','true')),
			'TotalHarga'=>htmlspecialchars($this->input->post('TotalHarga','true')),
			'BiayaKirim'=>htmlspecialchars($this->input->post('BiayaKirim','true')),
			'StandByOperator'=>htmlspecialchars($this->input->post('StandByOperator','true')),
			'Transportasi'=>htmlspecialchars($this->input->post('Transportasi','true')),
			'TransportasiLokal'=>htmlspecialchars($this->input->post('TransportasiLokal','true')),
			'Konsumsi'=>htmlspecialchars($this->input->post('Konsumsi','true')),
			'Akomodasi'=>htmlspecialchars($this->input->post('Akomodasi','true')),
			'TotalDibayar'=>htmlspecialchars($this->input->post('TotalDibayar','true')),
			'Personil'=>htmlspecialchars($this->input->post('Personil','true'))

		];

				//Transfering data to Model
		$this->jadwal_model->jadwal($data);
		//Loading View
		
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil ditambahkan</div>');
		//Loading View
		redirect('admin');
		}
	}

	public function editjadwal($noRFO)
	{	
		$data['title'] = 'Edit Jadwal';
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$data['b'] = $this->jadwal_model->editjadwal($noRFO);
		$data['ambilproduk'] = $this->produk_model->ambilproduk();

		$this->load->library('form_validation');


		$this->form_validation->set_rules('noRFO','no.RFO','required');
		$this->form_validation->set_rules('noSJ','no.SJ','required');
		$this->form_validation->set_rules('NamaPemesan','Nama Pemesan','required');
		$this->form_validation->set_rules('NoTlp','No.Tlp','required');
		$this->form_validation->set_rules('EmailEO','Email EO','required');
		$this->form_validation->set_rules('NamaEO','Nama EO','required');
		$this->form_validation->set_rules('AlamatWO','Alamat WO','required');
		$this->form_validation->set_rules('Orderan','Orderan','required');
		$this->form_validation->set_rules('JumlahUnit','Jumlah Unit','required');
		$this->form_validation->set_rules('TanggalSewa','Tanggal lSewa','required');
		$this->form_validation->set_rules('LamaSewa','Lama Sewa','required');
		$this->form_validation->set_rules('TanggalAntar','Tanggal Antar','required');
		$this->form_validation->set_rules('Venue','Venue','required');
		$this->form_validation->set_rules('AlamatVenue','Alamat Venue','required');
		$this->form_validation->set_rules('AlamatAntar','Alamat Antar','required');
		$this->form_validation->set_rules('HargaPerUnit','Harga Per Unit','required');
		$this->form_validation->set_rules('TotalHarga','Total Harga','required');
		$this->form_validation->set_rules('BiayaKirim','Biaya Kirim','required');
		$this->form_validation->set_rules('Transportasi','Transportasi','required');
		$this->form_validation->set_rules('TotalDibayar','Total Dibayar','required');
		$this->form_validation->set_rules('Personil','Personil','required');
		
			
		if ($this->form_validation->run()==false)
		{
				
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/editjadwal',$data);
		$this->load->view('templates/footer',$data);

		} else {
            $this->jadwal_model->editaksi();
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil dirubah</div>');
		//Loading View
		redirect('admin');
        }

	}	

	public function hapusjadwal()
	{	
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$noRFO = $this->uri->segment(3);
		$this->jadwal_model->hapusjadwal($noRFO);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil dihapus</div>');
			//Loading View
		redirect('admin');
				
	}

	public function tambahkaryawan()
	{
		$data['title'] = "Tambah Karyawan";
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$this->load->library('form_validation');

		$data['karyawan'] = $this->db->get('karyawan')->result_array();

		$this->form_validation->set_rules('nama','Nama', 'required|is_unique[user.email]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            ));
		$this->form_validation->set_rules('tanggallahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('tempatlahir','Tempat Lahir','required');
		$this->form_validation->set_rules('pendidikan','Pendidikan','required');
		$this->form_validation->set_rules('alamatsekarang','Alamat Sekarang','required');
		$this->form_validation->set_rules('agama','Agama','required');
		$this->form_validation->set_rules(
		'email', 'Email',
        'required|is_unique[user.email]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
    	);
		$this->form_validation->set_rules('posisi','Posisi','required');		

		if ($this->form_validation->run()==false)
		{
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/tambahkaryawan',$data);
		$this->load->view('templates/footer',$data);
		}else{

		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']     = '2048';
		$config['upload_path'] = './assets/img/profile/';

		$this->load->library('upload',$config);

		if ( ! $this->upload->do_upload('image'))
                {
                        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Gambar ke-1 yang anda masukkan kebesaran/ bukan gambar</div>');
				redirect('admin/tambahkaryawan');
                }
                else
                {
                        $gambar = $this->upload->data('file_name');
                        
                        
                }
                

		 $data1 = [
			'nama'=>htmlspecialchars($this->input->post('nama','true')),
			'jkl'=>htmlspecialchars($this->input->post('jkl','true')),
			'tanggallahir'=>htmlspecialchars($this->input->post('tanggallahir','true')),
			'tempatlahir'=>htmlspecialchars($this->input->post('tempatlahir','true')),
			'pendidikan'=>htmlspecialchars($this->input->post('pendidikan','true')),
			'alamatsekarang'=>htmlspecialchars($this->input->post('alamatsekarang','true')),
			'agama'=>htmlspecialchars($this->input->post('agama','true')),
			'image'=>$gambar,
			'is_active'=>1,
			'email'=>htmlspecialchars($this->input->post('email','true')),
			'posisi'=>htmlspecialchars($this->input->post('posisi','true'))
			
		];

		$data2=[
			'name'=>htmlspecialchars($this->input->post('nama','true')),
			'email'=>htmlspecialchars($this->input->post('email','true')),
			'image'=>$gambar,
			'password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			'role_id'=>htmlspecialchars($this->input->post('posisi','true')),
			'is_active'=>1,
			'date_create'=>time()

		];
		
		$this->karyawan_model->tambah($data1,$data2);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil ditambahakan</div>');
		//Loading View
		redirect('admin/tambahkaryawan');
	}


	}

	public function karyawan()
	{
		$data['title'] = "Karyawan";
		
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();
		
		$this->load->library('form_validation');

		$data['karyawan'] = $this->db->get('karyawan')->result_array();

		$this->form_validation->set_rules('nama','Nama', 'required|is_unique[user.email]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            ));
		$this->form_validation->set_rules(
		'email', 'Email',
        'required|is_unique[user.email]',
        array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
    	);
		$this->form_validation->set_rules('tanggallahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('tempatlahir','Tempat Lahir','required');
		$this->form_validation->set_rules('jkl','Jenis Kelamin','required');
		$this->form_validation->set_rules('pendidikan','Pendidikan','required');
		$this->form_validation->set_rules('alamatsekarang','Alamat Sekarang','required');
		$this->form_validation->set_rules('agama','Agama','required');
		$this->form_validation->set_rules('posisi','Posisi','required');
		
			
		if ($this->form_validation->run()==false)
		{

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/karyawan',$data);
		$this->load->view('templates/footer',$data);
	}else{
		 $nama= htmlspecialchars($this->input->post('nama','true'));
		 $tanggallahir= htmlspecialchars($this->input->post('tanggallahir','true'));
		 $tempatlahir= htmlspecialchars($this->input->post('tempatlahir','true'));
		 $jkl= htmlspecialchars($this->input->post('jkl','true'));
		 $pendidikan= htmlspecialchars($this->input->post('pendidikan','true'));
		 $alamatsekarang= htmlspecialchars($this->input->post('alamatsekarang','true'));
		 $agama= htmlspecialchars($this->input->post('agama','true'));
		 $posisi= htmlspecialchars($this->input->post('posisi','true'));
		 $email= $this->input->post('email');
		 $is_active = $this->input->post('is_active');

		$this->db->set('nama',$nama);
		$this->db->set('tanggallahir',$tanggallahir);
		$this->db->set('tempatlahir',$tempatlahir);
		$this->db->set('jkl',$jkl);
		$this->db->set('pendidikan',$pendidikan);
		$this->db->set('alamatsekarang',$alamatsekarang);
		$this->db->set('agama',$agama);
		$this->db->set('posisi',$posisi);
		$this->db->set('is_active',$is_active);
		$this->db->where('email',$email);
		$this->db->update('karyawan');

		$this->db->set('name',$nama);
		$this->db->set('is_active',$is_active);
		$this->db->where('email',$email);
		$this->db->update('user');

		$this->db->set('Personil',$nama);
		$this->db->where('Personil',$nama);
		$this->db->update('jadwal');

		 $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil dirubah</div>');
		//Loading View
		redirect('admin/karyawan');

			
	}

	}
	
	public function hapuskaryawan()
	{
		$data['user'] = $this->db->get_where('user',['email' =>$this->session->userdata('email')])->row_array();

		$id = $this->uri->segment(3);
		$data['karyawan'] = $this->db->get_where('karyawan',['id' =>$id])->row_array();
		$email = $data['karyawan']['email'];
		$this->karyawan_model->hapuskaryawan($email);

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Berhasil dihapus</div>');
			//Loading View
		redirect('admin/karyawan');
	}

	public function print()
	{
		$id = $this->uri->segment(3);
		$data['h'] = $this->db->get_where('jadwal',['noRFO' =>$id])->row_array();
		$this->load->view('admin/printjadwal',$data);
	}

	public function export()
	{
		$id = $this->uri->segment(3);
		$data['jadwal'] = $this->db->get_where('jadwal',['noRFO' =>$id])->row_array();
    // Load plugin PHPExcel nya
    include APPPATH.'PHPExcel-1.8/Classes/PHPExcel.php';
    include APPPATH.'PHPExcel-1.8\Classes\PHPExcel\Writer\Excel2007.php';
    
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('Condro')
                 ->setLastModifiedBy('Condro')
                 ->setTitle("Invoice")
                 ->setSubject("Data Invoice")
                 ->setDescription("Data Invoice Pengiriman")
                 ->setKeywords("Jadwal");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    $border_style= array(
    	'borders' => array(
    			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),

    		));

    $excel->getDefaultStyle()->getFont()->setName('Times New Roman');
    $excel->setActiveSheetIndex(0)->setCellValue('A2', "MOMOTOTOY COMMUNICATION"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A2:F2'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1
    
    
    $excel->setActiveSheetIndex(0)->setCellValue('G2', "SURAT JALAN");
    $excel->getActiveSheet()->mergeCells('G2:K3'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(22); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);


    $excel->setActiveSheetIndex(0)->setCellValue('A3', "Jl. Pegangsaan Barat No.24"); 
    $excel->setActiveSheetIndex(0)->setCellValue('A4', "Menteng - Jakarta Pusat");
    $excel->setActiveSheetIndex(0)->setCellValue('A5', "Ph. 0877-7600-0047 , 0812-8025-3534");

    $excel->setActiveSheetIndex(0)->setCellValue('H4', "NO");
    $noRFO = $data['jadwal']['noRFO'];
    $excel->setActiveSheetIndex(0)->setCellValue('I4', $noRFO);
    $excel->setActiveSheetIndex(0)->setCellValue('J4', "/MC-SJ/XI/". date('Y'));

    $excel->getActiveSheet()->getStyle('A5:K5')->applyFromArray($border_style);
    $excel->getActiveSheet()->getStyle('A19:K19')->applyFromArray($border_style);

    // Lakukan looping pada variabel siswa
      $d = $data['jadwal']['NamaPemesan'];
      $n = $data['jadwal']['NoTlp'];
      $aa = $data['jadwal']['AlamatAntar'];
      
      $excel->setActiveSheetIndex(0)->setCellValue('A6', 'Kepada YTH');
      $excel->setActiveSheetIndex(0)->setCellValue('A7', 'Nama');
      $excel->setActiveSheetIndex(0)->setCellValue('A8', 'No Tlp');
      $excel->setActiveSheetIndex(0)->setCellValue('A9', 'Alamat Kirim');

      $excel->setActiveSheetIndex(0)->setCellValue('C7', ':');
      $excel->setActiveSheetIndex(0)->setCellValue('C8', ':');
      $excel->setActiveSheetIndex(0)->setCellValue('C9', ':');
      

      $excel->setActiveSheetIndex(0)->setCellValue('D7', $d);
      $excel->setActiveSheetIndex(0)->setCellValue('D8', $n);
      $excel->setActiveSheetIndex(0)->setCellValue('D9', $aa);
      $l = $data['jadwal']['TanggalAntar'];
      $jam = date('H:i');
      $excel->setActiveSheetIndex(0)->setCellValue('I9', 'Jam');
      $excel->setActiveSheetIndex(0)->setCellValue('J9',$jam );
      $excel->setActiveSheetIndex(0)->setCellValue('K9', 'WIB');

      $bt_style= array(
    	'borders' => array(
    			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),

    		));

      $excel->getActiveSheet()->getStyle('A10:K10')->applyFromArray($bt_style); 

      $excel->setActiveSheetIndex(0)->setCellValue('A10', 'Item');
      $excel->setActiveSheetIndex(0)->setCellValue('E10', 'Keterangan');
      $excel->setActiveSheetIndex(0)->setCellValue('G10', 'Penerima');
      $excel->setActiveSheetIndex(0)->setCellValue('J10', 'QTY');
      $excel->setActiveSheetIndex(0)->setCellValue('K10', 'Keterangan');

      $excel->getActiveSheet()->getStyle('A10:K10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

      $excel->setActiveSheetIndex(0)->setCellValue('A11', 'Base Station HME DX-100');
      $excel->setActiveSheetIndex(0)->setCellValue('A12', 'Headset + Beltpack');
      $excel->setActiveSheetIndex(0)->setCellValue('A13', 'Antena');
      $excel->setActiveSheetIndex(0)->setCellValue('A14', 'Power Supply');
      $excel->setActiveSheetIndex(0)->setCellValue('A15', 'Battery Backup');
      $excel->setActiveSheetIndex(0)->setCellValue('A16', 'Charger  Clearcom');
      $excel->setActiveSheetIndex(0)->setCellValue('A17', 'Headset Remote Eartec');
      $excel->setActiveSheetIndex(0)->setCellValue('A18', 'Hub + Power Supply');
      $excel->setActiveSheetIndex(0)->setCellValue('A19', 'Battery Backup'); 

      for($i=11;$i<=19;$i++){
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$i, '0');
  };

  	for ($c=11; $c <=19 ; $c++) { 
  		$excel->setActiveSheetIndex(0)->setCellValue('E'.$c, 'Keadaan Baik');
  	};


  	 $br_style= array(
    	'borders' => array(
    			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),

    		));
     $excel->getActiveSheet()->getStyle('F10:F28')->applyFromArray($br_style);

     $excel->setActiveSheetIndex(0)->setCellValue('A20', 'Note : Dengan menandatangani Surat Jalan ini, maka kami menyetujui');
     $excel->setActiveSheetIndex(0)->setCellValue('A21', 'hal sbb :');
     $excel->setActiveSheetIndex(0)->setCellValue('A22', '1. Setelah serah terima, unit menjadi tanggung jawab penyewa');
     $excel->setActiveSheetIndex(0)->setCellValue('A23', 'dan segala kehilangan atau kerusakan akan diganti saat itu juga');
     $excel->setActiveSheetIndex(0)->setCellValue('A24', '2. Kehilangan/ Kerusakan Handy Talky sebesar Rp.1.500.000/unit ,Antena');
     $excel->setActiveSheetIndex(0)->setCellValue('A25', 'Rp.200.000/pcs,Handsfree Rp. 50.000/unit, Clearcom 12.000USD/unit,');
     $excel->setActiveSheetIndex(0)->setCellValue('A26', 'Megaphone TOA Rp 600.000/unit, Baterai TOA Rp. 20.000/pcs,');
     $excel->setActiveSheetIndex(0)->setCellValue('A27', 'Eartec Rp. 5.000.000/unit');
     $excel->setActiveSheetIndex(0)->setCellValue('A28', '3. Penyewa akan menjaga unit dengan Sebaik-baiknya');

     $excel->getActiveSheet()->getStyle('A20:A28')->getFont()->setSize(7);


      $excel->setActiveSheetIndex(0)->setCellValue('G11', 'Charger Eartec');
      $excel->setActiveSheetIndex(0)->setCellValue('G12', 'Headset Master Eartec');
      $excel->setActiveSheetIndex(0)->setCellValue('G13', 'HT ICOM V80 + Antena');
      $excel->setActiveSheetIndex(0)->setCellValue('G14', 'Handsfree');
      $excel->setActiveSheetIndex(0)->setCellValue('G15', 'Baterai Cadangan  ');
      $excel->setActiveSheetIndex(0)->setCellValue('G16', 'Tas');
      $excel->setActiveSheetIndex(0)->setCellValue('G17', 'Charger HT ');
      $excel->setActiveSheetIndex(0)->setCellValue('G18', 'Megaphone TOA');
      $excel->setActiveSheetIndex(0)->setCellValue('G19', 'Baterai Cadangan TOA');

      $excel->getActiveSheet()->mergeCells('G20:K20');
      $excel->setActiveSheetIndex(0)->setCellValue('G20', 'Jakarta, '. date('m F Y'));
      $excel->getActiveSheet()->getStyle('G20')->getFont()->setBold(TRUE);
      $excel->getActiveSheet()->getStyle('G20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $excel->getActiveSheet()->mergeCells('G21:H21');
      $excel->setActiveSheetIndex(0)->setCellValue('G21','Penerima');
      $excel->getActiveSheet()->getStyle('G21')->getFont()->setBold(TRUE);
      $excel->getActiveSheet()->getStyle('G21')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $excel->getActiveSheet()->mergeCells('J21:K21');
      $excel->setActiveSheetIndex(0)->setCellValue('J21', 'Pengirim');
      $excel->getActiveSheet()->getStyle('J21')->getFont()->setBold(TRUE);
      $excel->getActiveSheet()->getStyle('J21')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $excel->getActiveSheet()->mergeCells('G27:I27');
      $excel->setActiveSheetIndex(0)->setCellValue('G27', '(                         )');
      $excel->getActiveSheet()->getStyle('G27')->getFont()->setBold(TRUE);
      $excel->getActiveSheet()->getStyle('G27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

      $excel->getActiveSheet()->mergeCells('J27:K27');
      $excel->setActiveSheetIndex(0)->setCellValue('J27', '(                          )');
      $excel->getActiveSheet()->getStyle('J27')->getFont()->setBold(TRUE);
      $excel->getActiveSheet()->getStyle('J27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $excel->getActiveSheet()->mergeCells('J28:K28');
      $excel->setActiveSheetIndex(0)->setCellValue('J28', 'Operational');
      $excel->getActiveSheet()->getStyle('J28')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	



      for($s=11;$s<=19;$s++){
      $excel->setActiveSheetIndex(0)->setCellValue('J'.$s, '0');
  };

  	for ($p=11; $p <=19 ; $p++) { 
  		$excel->setActiveSheetIndex(0)->setCellValue('K'.$p, 'Keadaan Baik');
  	};
      
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(12); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(3); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(6); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(12); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(11); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(5); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('J')->setWidth(7); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('K')->setWidth(14); // Set width kolom E
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="invoice.csv"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
	}

}
