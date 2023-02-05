<?php

class Stock_model extends CI_Model{

    public $tableName = 'stock';
    public function __construct(){
        parent::__construct();
    }

    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function get_all($params = array()){
       $params = $this->set_params($params);

       if($params['select']) {
           $this->db->select($params['select']);
       } else {
           $this->db->select(array(
               "stock.id as id",
               "stockcards.stockcard_title as card_name",
               "warehouse.warehouse_name as ware_name",
               "shelves.shelves_name as shelv_name",
               "stock.type as stck_type",
               "stock.total as stck_total",
               "users.full_name as username",
               "stock.createdAt as created",
               "stock.updatedAt as updated",
               "stock.deletedAt as deleted",
               "stock.description as descript",
               "stock.isActive as activated"

           ));
       }

       if($params['where']){
           $this->db->where($params['where']);
       } else {
           $this->db->where(
               array(
                   "stock.deletedAt" => null
               )
           );
       }

       $this->db->join("stockcards","stockcards.id = stock.stockcard_id","left");
       $this->db->join("warehouse"  ,"warehouse.id =  stock.warehouse_id","left");
       $this->db->join("shelves","shelves.id = stock.shelves_id","left");
       $this->db->join("users","users.id = stock.user_id","left");

        if ($params['array']){
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