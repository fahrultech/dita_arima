<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class JumlahAlatTangkap_model extends CI_Model
{
    public $table = 'datatangkapanikanperalat';
    public $order = 'IDAlatTangkap';

    // Konstructor
    function __construct(){
        parent::__construct();
    }
    function getAll(){
        return $this->db->get($this->table)->result();
    }
    function getDataByMonthAndYear($data=array()){
        $this->db->select('Bulan, datatangkapanikanperalat.IDAlatTangkap,NamaAlatTangkap, IDIkan,JumlahTangkapan');
        $this->db->join('alattangkap','alattangkap.IDAlatTangkap = datatangkapanikanperalat.IDAlatTangkap');
        $this->db->from($this->table);
        $this->db->order_by('datatangkapanikanperalat.IDAlatTangkap, IDIkan');
        $this->db->where($data);
        return $this->db->get()->result();
    }
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    function getById($id){
        $this->db->from($this->table);
        $this->db->where($this->id,$id);
        $query = $this->db->get();
        return $query->row();
    }
    function update($id, $data){
        $this->db->update($this->table, $data, $id);
        return $this->db->affected_rows();
    }
    function deleteById($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }


}