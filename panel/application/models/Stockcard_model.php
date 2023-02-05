<?php 

class Stockcard_model extends CI_Model {

    public $tableName = 'stockcards';

    public function __construct(){

        parent::__construct();

    }

    // Tek Bir Kayıt Getirmek İçin Kullanılacak Metot

    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    /*  Tüm Kayıtları Bize Getirecek Olan Metot */
    public function get_all($params = array()){
        $params = $this->set_params($params);

        if($params['select']){
            $this->db->select($params['select']);
        } else {
            $this->db->select(array(
                "stockcards.id as id",
                "stockcards.title as stkcard_name",
                "category.category_name as cat_name",
                "sub_category.sub_category_name as subcat_name",
                "products.title as prod_name",
                "users.full_name as username",
                "stockcards.createdAt as created",
                "stockcards.updatedAt as updated",
                "stockcards.deletedAt as deleted",
                "stockcards.isActive as activated"
            ));

        }

        //! Hangi Verilerin Geleceğini Belirledik (silinme tarihi boş olmayan hepsi gelecek)
        if($params['where']){
            $this->db->where($params['where']);
        } else {
            $this->db->where(
                array(
                    "stockcards.deletedAt" => null
                )
            );
        }

        /* Joinler */
        $this->db->join("users", "users.id = stockcards.user_id", "left");
        $this->db->join("category", "category.id = stockcards.category_id", "left");
        $this->db->join("sub_category", "sub_category.id = stockcards.sub_category_id", "left");
        $this->db->join("products","products.id = stockcards.product_id","left");
        /* /Joinler */

        if($params['array']){
            $result = $this->db->get($this->tableName)->result();
        } else {
            $result = $this->db->get($this->tableName)->row();
        }

        return $result;

    }

    // Veritabanına kayıt eklemek 
    public function add($data = array()){
        return $this->db->insert($this->tableName, $data);
    }

    public function update($where = array(), $data = array()) {
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = array(), $data = array()) {
        return $this->db->where($where)->update($this->tableName, $data);
    }

    private function set_params($datas = array()){
        $this->load->helper('array');
        $result = array(
            "array",
            "select",
            "where"
        );
        return elements($result, $datas);
    }

}