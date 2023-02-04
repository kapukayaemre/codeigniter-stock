<?php

class Shelves_model extends CI_Model{

    public $tableName = 'shelves';
    public function __construct(){
        parent::__construct();
    }

    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function get_all($params = array()){
        $params = $this->set_params($params);

        if($params['select']){
            $this->db->select($params['select']);
        } else {
            $this->db->select(array(
                "shelves.id as id",
                "shelves.name as shelv_name",
                "warehouse.warehouse_name as ware_name",
                "products.title as prod_name",
                "users.full_name as username",
                "shelves.createdAt as created",
                "shelves.updatedAt as updated",
                "shelves.deletedAt as deleted",
                "shelves.isActive as activated"
            ));
        }

        //! Hangi Verilerin Geleceğini Belirledik (silinme tarihi boş olmayan hepsi gelecek)
        if($params['where']){
            $this->db->where($params['where']);
        } else {
            $this->db->where(
                array(
                    "shelves.deletedAt" => null
                )
            );
        }
        /* Joinler */
        $this->db->join("users", "users.id = shelves.user_id", "left");
        $this->db->join("warehouse", "warehouse.id = shelves.warehouse_id", "left");
        $this->db->join("products", "products.id = shelves.product_id", "left");
        /* /Joinler */

        if($params['array']){
            $result = $this->db->get($this->tableName)->result();
        } else {
            $result = $this->db->get($this->tableName)->row();
        }

        return $result;

    }
    public function add($data = array()){
        return $this->db->insert($this->tableName, $data);
    }

    public function update($where = array(), $data = array()){
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = array()){
        return $this->db->where($where)->delete($this->tableName);
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