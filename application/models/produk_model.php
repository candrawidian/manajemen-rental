<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_model extends CI_Model{

	 public function tambahproduk($data)
    {

        $this->db->insert('produk', $data); 
    }

    public function editproduk()
    {		
    	$id = $this->input->post('id');
    	$namaProduk = $this->input->post('namaProdukedit');
        $HargaPerUnit = $this->input->post('HargaPerUnitedit');
		$JumlahUnit = $this->input->post('JumlahUnitedit');
    		
    	$this->db->set('namaProduk', $namaProduk);
        $this->db->set('HargaPerUnit', $HargaPerUnit);
        $this->db->set('JumlahUnit', $JumlahUnit);
       
         $this->db->where('id', $id);
         $this->db->update('produk');
    	
    }

    public function hapusproduk($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('produk');
    }

    public function ambilproduk()
    {
        $hasil=$this->db->query("SELECT * FROM produk")->result_array();

            return $hasil;
    }


}