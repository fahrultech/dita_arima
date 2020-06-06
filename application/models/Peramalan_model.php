<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Peramalan_model extends CI_Model
{
    public $table = 'datatangkapanikan';
    public $order = 'IDDataTangkapanIkan';

    // Konstructor
    function __construct(){
        parent::__construct();
    }
    function getAll(){
        return $this->db->get($this->table)->result();
    }
    function getDataByKecamatanAndJenis($kc,$id){
        $this->db->select('Bulan,Tahun,JumlahTangkapanIkan');
        $this->db->from($this->table);
        $this->db->where('IDKecamatan',$kc);
        $this->db->where('IDIkan',$id);
        $this->db->order_by('Tahun,Bulan');
        $query = $this->db->get();
        return $query->result();
    }
    function getDataByKecamatanAndJenisRamal($kc,$id,$ta){
        $this->db->select('Bulan,Tahun,JumlahTangkapanIkan');
        $this->db->from($this->table);
        $this->db->where('IDKecamatan',$kc);
        $this->db->where('IDIkan',$id);
        $this->db->where('Tahun >=',$ta);
        $this->db->where('Tahun <=',2019);
        $this->db->order_by('Tahun,Bulan');
        $query = $this->db->get();
        return $query->result();
    }
    function getDataByKecamatanAndJenisPredik($kc,$id,$ta){
        $this->db->select('Bulan,Tahun,JumlahTangkapanIkan');
        $this->db->from($this->table);
        $this->db->where('IDKecamatan',$kc);
        $this->db->where('IDIkan',$id);
        $this->db->where('Tahun',$ta);
        $this->db->order_by('Tahun,Bulan');
        $query = $this->db->get();
        return $query->result();
    }
    function getDataByKecamatanAndJenisAndYear($kc,$id,$ta,$th){
        $this->db->select('Bulan,Tahun,JumlahTangkapanIkan');
        $this->db->from($this->table);
        $this->db->where('IDKecamatan',$kc);
        $this->db->where('IDIkan',$id);
        $this->db->where('Tahun >=',$ta);
        $this->db->where('Tahun <=',$th);
        $this->db->order_by('Tahun,Bulan');
        $query = $this->db->get();
        return $query->result();
    }
}