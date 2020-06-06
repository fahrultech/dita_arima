<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class SmsGateway_model extends CI_Model
{
    public function runDaemon()
    {
        return $inbox = $this->getInbox();
        if(!$inbox){
            return;
        }

        // Persiapan Balasan
        //$data = $this->prepareReplyData($inbox);

        //Reply SMS
        //$this->reply($data);

        //Menampung ID sms yang sudah dibalas
        //$IDS = $this->collectID($inbox);

        // Hapus sms yang sudah di balas
        //$this->deleteRepliedMessage($IDS);
    }

    private function deleteRepliedMessage($IDS)
    {

    }
    private function getInbox(){
        $pre = $this->db->select('ID,SenderNumber')
                        ->get('inbox')
                        ->result();
        foreach($pre as $p){
            if($this->db->select('IDKelompok')->from('kelompoknelayan')->where('NoHP',$p->SenderNumber)->get()->row() == null){
                $this->deleteById($p->ID);
            }
            if($this->db->select('id')->from('replymessage')->where('messageid',$p->ID)->get()->row() != null){
                $this->deleteById($p->ID);
            }
        }
        return $this->db->select('ID, TextDecoded, SenderNumber,IDKecamatan')
                    ->from('inbox')
                    ->like('TextDecoded', 'Tuna')
                    ->or_like('TextDecoded', 'Cakalang')
                    ->or_like('TextDecoded', 'Tongkol')
                    ->join('kelompoknelayan','kelompoknelayan.NoHP = inbox.SenderNumber')
                    ->get()
                    ->row();
    }
    function deleteById($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('inbox');
    }
    function saveData($idikan,$jumlahTangkapan,$bulan,$tahun,$kecamatan){
        $data = array(
            'Bulan' => $bulan,
            'Tahun' => $tahun,
            'IDKecamatan' => $kecamatan,
            'IDIkan' => $idikan,
            'JumlahTangkapanIkan' => $jumlahTangkapan

        );
        $this->db->insert('datatangkapanikan',$data);
    }
    function isExist($bulan,$tahun,$alattangkap,$idikan){
        return $this->db->select('JumlahTangkapan')
                        ->where('Bulan',$bulan)
                        ->where('Tahun',$tahun)
                        ->where('IDAlatTangkap',$alattangkap)
                        ->where('IDIkan',$idikan)
                        ->get('datatangkapanikanperalat')
                        ->row();
    }
    function saveReplyID($data){
       $this->db->insert('replymessage',$data);
    }
    function saveDataAlatTangkap($data){
        foreach($data as $dt){
            $this->db->insert('datatangkapanikanperalat',$dt);
        }
    }
    function updateDataAlatTangkap($data){
        foreach($data as $dt){
            $sum = $this->isExist($dt["Bulan"],$dt["Tahun"],$dt["IDAlatTangkap"],$dt["IDIkan"])->JumlahTangkapan + $dt["JumlahTangkapan"];
            $this->db->set('JumlahTangkapan',$sum)
            ->where('Bulan',$dt["Bulan"])
            ->where('Tahun',$dt["Tahun"])
            ->where('IDAlatTangkap',$dt["IDAlatTangkap"])
            ->where('IDIkan',$dt["IDIkan"])
            ->update('datatangkapanikanperalat');
        }
        return array("message" => "success");
    }
    function getNamaIkan($id){
        return $this->db->select('NamaIkan')->where('IDIkan',$id)->get('jenisikan')->row();
    }
}