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
               "products.id as product_id",
               "products.title as product_name",
               "warehouse.warehouse_name as warehouse_name",
               "shelves.shelves_name as shelves_name",
               "stock.type as type",
               "stock.total as total",
               "stock.total_stock as total_stock",
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
        $this->db->join("products", "products.id = stock.product_id");
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

        if(!($this->db->select("*")->order_by('id',"DESC")->get($this->tableName)->result())) {
            $data['total_stock'] = $data['total']; 
        } else {
            $query = $this->db->get($this->tableName);
            foreach ($query->result() as $row)
            {   
                if($data['product_id'] != $row->product_id){
                    $data['total_stock'] = $data['total'];
                } else {

                    if(($data['type'] == 'in') && ($data['product_id'] == $row->product_id)){
                        $data['total_stock'] = $data['total'] + $row->total_stock;  
                    }else if(($data['type'] == 'out') && ($data['product_id'] == $row->product_id)){
                        $data['total_stock'] =  $row->total_stock - $data['total'];  
                    }   
                }
                   
            }
        }
        
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