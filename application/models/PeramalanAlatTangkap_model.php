<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class PeramalanAlatTangkap_model extends CI_Model
{
    public $table = 'datatangkapanikanperalat';
    public $order = 'Tahun,Bulan';

    // Konstructor
    function __construct(){
        parent::__construct();
    }
    function getAll(){
        return $this->db->get($this->table)->result();
    }
    function getDataByAlatTangkapAndJenis($at,$id){
        $this->db->select('Bulan,Tahun,JumlahTangkapan');
        $this->db->from($this->table);
        $this->db->where('IDAlatTangkap',$at);
        $this->db->where('IDIkan',$id);
        $this->db->order_by('Tahun,Bulan');
        $query = $this->db->get();
        return $query->result();
    }
    function getDataByAlatTangkapAndJenisRamal($at,$id,$ta){
        $this->db->select('Bulan,Tahun,JumlahTangkapan');
        $this->db->from($this->table);
        $this->db->where('IDAlatTangkap',$at);
        $this->db->where('IDIkan',$id);
        $this->db->where('Tahun >=',$ta);
        $this->db->order_by('Tahun,Bulan');
        $query = $this->db->get();
        return $query->result();
    }
    function getDataByAlatTangkapAndJenisAndYear($at,$id,$ta,$th){
        $this->db->select('Bulan,Tahun,JumlahTangkapan');
        $this->db->from($this->table);
        $this->db->where('IDAlatTangkap',$at);
        $this->db->where('IDIkan',$id);
        $this->db->where('Tahun >=',$ta);
        $this->db->where('Tahun <=',$th);
        $this->db->order_by('Tahun,Bulan');
        $query = $this->db->get();
        return $query->result();
    }
}