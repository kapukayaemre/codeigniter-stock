<?php

class Warehouse_model extends CI_Model{

    public $tableName = 'warehouse';
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
                "warehouse.id as id",
                "warehouse.warehouse_name as ware_name",
                "warehouse.city as ware_city",
                "warehouse.district as ware_dist",
                "users.full_name as username",
                "warehouse.createdAt as created",
                "warehouse.updatedAt as updated",
                "warehouse.deletedAt as deleted",
                "warehouse.isActive as activated"
            ));

        }

        //! Hangi Verilerin Geleceğini Belirledik (silinme tarihi boş olmayan hepsi gelecek)
        if($params['where']){
            $this->db->where($params['where']);
        } else {
            $this->db->where(
                array(
                    "warehouse.deletedAt" => null
                )
            );
        }

        /* Joinler */
        $this->db->join("users", "users.id = warehouse.user_id", "left");
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

    public function delete($where = array(), $data = array()){
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