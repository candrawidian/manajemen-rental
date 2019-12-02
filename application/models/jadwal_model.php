<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jadwal_model extends CI_Model{

    function jadwal($data){
// Inserting in Table(students) of Database(college)
        $this->db->insert('jadwal', $data);

    }

   public function editjadwal($noRFO)
    {
        return $this->db->get_where('jadwal', ['noRFO' => $noRFO])->row_array();
    }

    
    public function editaksi()
    {   
            $noRFO = $this->input->post('noRFO',true);
            $noSJ= $this->input->post('noSJ',true);
            $NamaPemesan= $this->input->post('NamaPemesan',true);
            $NoTlp= $this->input->post('NoTlp',true);
            $EmailEO= $this->input->post('EmailEO',true);
            $NamaEO= $this->input->post('NamaEO',true);
            $AlamatWO=$this->input->post('AlamatWO',true);
            $Orderan= $this->input->post('Orderan',true);
            $JumlahUnit= $this->input->post('JumlahUnit',true);
            $TanggalSewa= $this->input->post('TanggalSewa',true);
            $LamaSewa= $this->input->post('LamaSewa',true);
            $TanggalAntar= $this->input->post('TanggalAntar',true);
            $Venue=$this->input->post('Venue',true);
            $AlamatVenue=$this->input->post('AlamatVenue',true);
            $AlamatAntar=$this->input->post('AlamatAntar',true);
            $HargaPerUnit=$this->input->post('HargaPerUnit',true);
            $TotalHarga=$this->input->post('TotalHarga',true);
            $BiayaKirim=$this->input->post('BiayaKirim',true);
            $StandByOperator=$this->input->post('StandByOperator',true);
            $Transportasi=$this->input->post('Transportasi',true);
            $TransportasiLokal=$this->input->post('TransportasiLokal',true);
            $Konsumsi=$this->input->post('Konsumsi',true);
            $Akomodasi=$this->input->post('Akomodasi',true);
            $TotalDibayar=$this->input->post('TotalDibayar',true);
            $Personil=$this->input->post('Personil',true);

           
            $this->db->set('noRFO', $noRFO);
            $this->db->set('noSJ', $noSJ);
            $this->db->set('NamaPemesan', $NamaPemesan);
            $this->db->set('NoTlp', $NoTlp);
            $this->db->set('EmailEO', $EmailEO);
            $this->db->set('NamaEO', $NamaEO);
            $this->db->set('AlamatWO', $AlamatWO);
            $this->db->set('Orderan', $Orderan);
            $this->db->set('JumlahUnit', $JumlahUnit);
            $this->db->set('TanggalSewa', $TanggalSewa);
            $this->db->set('LamaSewa', $LamaSewa);
            $this->db->set('TanggalAntar', $TanggalAntar);
            $this->db->set('Venue', $Venue);
            $this->db->set('AlamatVenue', $AlamatVenue);
            $this->db->set('AlamatAntar', $HargaPerUnit);
            $this->db->set('HargaPerUnit', $HargaPerUnit);
            $this->db->set('TotalHarga', $TotalHarga);
            $this->db->set('BiayaKirim', $BiayaKirim);
            $this->db->set('StandByOperator', $StandByOperator);
            $this->db->set('Transportasi', $Transportasi);
            $this->db->set('TransportasiLokal', $TransportasiLokal);
            $this->db->set('Konsumsi', $Konsumsi);
            $this->db->set('Akomodasi', $Akomodasi);
            $this->db->set('TotalDibayar', $TotalDibayar);
            $this->db->set('Personil', $Personil);


            $this->db->where('noRFO', $noRFO);
            $this->db->update('jadwal');
        }

    public function hapusjadwal($noRFO)
    {
        $this->db->where('noRFO', $noRFO);
        $this->db->delete('jadwal');
    }

    // public function ambil(){
        
    // $t = "PakAhmad";
    //  $hasi=$this->db->query("SELECT COUNT(Personil) FROM jadwal WHERE Personil='".$t."'")->result_array();
    //    return $hasi;
    // }

    public function hasil()
    {
        $hasil=$this->db->query("SELECT * FROM jadwal")->result_array();

            return $hasil;
    }
    public function Totalbayar()
    {
        $query=$this->db->query("SELECT TotalDibayar FROM jadwal")->result_array();

        return $query;
    }
}
