<?php

class Category_api_model extends CI_Model{
    public $tableName = 'category';
    public function __construct(){
        parent::__construct();
        $this->output->set_content_type('application/json');
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
        return $this->output->set_status_header(200)->set_output(json_encode($result));

    }

    public function add($data = array()){

        return json_encode($this->db->insert($this->tableName, $data));
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