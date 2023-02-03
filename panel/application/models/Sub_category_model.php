<?php

class Sub_category_model extends CI_Model{

    public $tableName = 'sub_category';
    public function __construct(){
        parent::__construct();
    }

    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function get_all($where = array()){
        return $this->db->where($where)->get($this->tableName)->result();
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

    public function list_join(){
        $this->db->select("sub_category.*,category.category_name,users.full_name");
        $this->db->from('sub_category');
        $this->db->join('category', 'category.id = sub_category.category_id');
        $this->db->join('users', 'users.id = sub_category.user_id');
        return $this->db->get()->result();
    }

    public function add_join(){
        $this->db->select("category.*,users.full_name");
        $this->db->from('category');
        $this->db->join('users', 'users.id = category.user_id');
        return $this->db->get()->result();
    }

}