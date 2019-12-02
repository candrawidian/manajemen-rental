<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan_model extends CI_Model{

    function tambah($data1,$data2){
// Inserting in Table(students) of Database(college)
        $this->db->insert('karyawan', $data1);
        $this->db->insert('user', $data2);

    }

    public function hapuskaryawan($email)
    {
        $this->db->where('email', $email);
        $this->db->delete('karyawan');

        $this->db->where('email', $email);
        $this->db->delete('user');
    }

   
}