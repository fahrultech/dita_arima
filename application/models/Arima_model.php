<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Arima_model extends CI_Model
{
    public $table = 'latih';
    public $order = 'id';

    // Konstructor
    function __construct(){
        parent::__construct();
    }
    function getAll(){
        return $this->db->get($this->table)->result();
    }
}