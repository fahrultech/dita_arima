<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Sms_model extends CI_Model{
     protected $table = 'outbox';

     public function getValidationRules(){
         return [
             [
                 'field' => 'DestinationNumber',
                 'label' => 'Nomor HP',
                 'rules' => 'trim|required|numeric|max_length[15]'
             ],
             [
                 'field' => 'TextDecoded',
                 'label' => 'Isi SMS',
                 'rules' => 'trim|required|max_length[160]'
             ]
         ];
     }
     function getNoHP(){
         $this->db->select('NoHP,NamaKelompok');
         $this->db->from('kelompoknelayan');
         $query = $this->db->get();
         return $query->result();
     }
     public function getDefaultValues(){
        return [
            'DestinationNumber' => '',
            'TextDecoded'       => ''
        ];
     }

     public function formatPhoneNumber($num)
     {
        $noHP = $num;
        $pos  = strpos($noHP, '0', 0);

        if ($pos === 0) {
            $noHP = substr_replace($noHP, '+62', 0, 1);
        }

        return $noHP;
     }

     public function insert($data){
        $data["DestinationNumber"] = $this->formatPhoneNumber(
            $data["DestinationNumber"]
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
     }
    
}