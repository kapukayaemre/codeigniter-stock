<?php

class Category_model extends CI_Model{
    public $tableName = 'category';
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
                "category.id as id",
                "category.user_id as userid",
                "category.category_name as name",
                "users.full_name as username",
                "category.createdAt as created",
                "category.updatedAt as updated",
                "category.deletedAt as deleted",
                "category.isActive as activated"
            ));
        }

        //! Hangi Verilerin Geleceğini Belirledik (silinme tarihi boş olmayan hepsi gelecek)
        if($params['where']){
            $this->db->where($params['where']);
        } else {
            $this->db->where(
                array(
                    "category.deletedAt" => null
                )
            );
        }

        /* Joinler */
        $this->db->join("users", "users.id = category.user_id", "left");
        /* /Joinler */

        if($params['array']){
            $result = $this->db->get($this->tableName)->result();
        } else {
            $result = $this->db->get($this->tableName)->row();
        }
        return $result;

    }


        // return $this->db->where($where)->get($this->tableName)->result();

    public function add($data = array()){
        return $this->db->insert($this->tableName, $data);
    }

    public function update($where = array(), $data = array()){
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = array()){
        return $this->db->where($where)->delete($this->tableName);
    }

 /*    public function get_data($params = array()){
        $params = $this->set_params($params);

        if($params['select']){
            $this->db->select($params['select']);
        } else {
            $this->db->select(array(
                "category.id as id",
                "category.user_id as userid",
                "category.category_name as name",
                "users.full_name as username",
                "category.createdAt as created",
                "category.updatedAt as updated",
                "category.deletedAt as deleted",
                "category.isActive as activated"
            ));
        }

        if($params['where']){
            $this->db->where($params['where']);
        } else {
            $this->db->where(
                array(
                    "category.deletedAt" => null
                )
            );
        }

        $this->db->join("users", "users.id = category.user_id", "left");
        
        if($params['array']){
            $result = $this->db->get($this->tableName)->result();
        } else {
            $result = $this->db->get($this->tableName)->row();
        }
        return $result;

    } */

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