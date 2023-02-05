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
    public function get_all($params = array()){
        $params = $this->set_params($params);

        if($params['select']){
            $this->db->select($params['select']);
        } else {
            $this->db->select(array(
                "products.id as id",
                "products.title as pro_name",
                "products.description as pro_desc",
                "category.category_name as cat_name",
                "sub_category.sub_category_name as subcat_name",
                "users.full_name as username",
                "products.createdAt as created",
                "products.updatedAt as updated",
                "products.deletedAt as deleted",
                "products.isActive as activated"
            ));

        }

        //! Hangi Verilerin Geleceğini Belirledik (silinme tarihi boş olmayan hepsi gelecek)
        if($params['where']){
            $this->db->where($params['where']);
        } else {
            $this->db->where(
                array(
                    "products.deletedAt" => null
                )
            );
        }

        /* Joinler */
        $this->db->join("users", "users.id = products.user_id", "left");
        $this->db->join("category", "category.id = products.category_id", "left");
        $this->db->join("sub_category", "sub_category.id = products.sub_category_id", "left");
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