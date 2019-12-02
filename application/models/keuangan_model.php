<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class keuangan_model extends CI_Model{

	function ambilfilter($awal,$akhir)
	{
		$this->db->where('tanggal>=', $awal);
		$this->db->where('tanggal<=', $akhir);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('keuangan'); 
		return $query->result_array();
	}

	function ambilmasuk($awal,$akhir)
	{
		$this->db->where('tanggal>=', $awal);
		$this->db->where('tanggal<=', $akhir);
		$this->db->where('status', 'Pemasukan');
		$this->db->order_by("id", "desc");
		$query = $this->db->get('keuangan'); 
		return $query->result_array();
	}

	function ambilkeluar($awal,$akhir)
	{
		$this->db->where('tanggal>=', $awal);
		$this->db->where('tanggal<=', $akhir);
		$this->db->where('status', 'Pengeluaran');
		$this->db->order_by("id", "desc");
		$query = $this->db->get('keuangan'); 
		return $query->result_array();
	}

	function ambildatamasuk()
	{
		$this->db->where('status', 'Pemasukan');
		$this->db->order_by("id", "desc");
		$query = $this->db->get('keuangan'); 
		return $query->result_array();
	}

	function ambildatakeluar()
	{
		$this->db->where('status', 'Pengeluaran');
		$this->db->order_by("id", "desc");
		$query = $this->db->get('keuangan'); 
		return $query->result_array();
	}

	function ambildata()
	{	
		
		$this->db->order_by("id", "desc");
		$query = $this->db->get('keuangan'); 
		return $query->result_array();
	}

    function keuangan($data){
// Inserting in Table(students) of Database(college)
        $this->db->insert('keuangan', $data);

    }

    function hapusdata($id)
    {

        $this->db->where('id', $id);

        $this->db->delete('keuangan');
    }

    function ubahdata(){
    	$id = $this->input->post('id');
    	$judul = $this->input->post('judul');
        $tanggal = $this->input->post('tanggal');
        $status = $this->input->post('status');
		$nominal = $this->input->post('nominal');
    		
    	$this->db->set('judul', $judul);
    	$this->db->set('status', $status);
        $this->db->set('tanggal', $tanggal);
        $this->db->set('nominal', $nominal);
       
         $this->db->where('id', $id);
         $this->db->update('keuangan');
    	
    }
}