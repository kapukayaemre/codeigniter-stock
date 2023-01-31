<?php 

class Product_model extends CI_Model {

    public $tableName = 'products';

    public function __construct(){

        parent::__construct();

    }

    // Tek Bir Kayıt Getirmek İçin Kullanılacak Metot

    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    /*  Tüm Kayıtları Bize Getirecek Olan Metot */
    public function get_all($where = array()){
        return $this->db->where($where)->get($this->tableName)->result();
    }

    // Veritabanına kayıt eklemek 
    public function add($data = array()){
        return $this->db->insert($this->tableName, $data);
    }

}