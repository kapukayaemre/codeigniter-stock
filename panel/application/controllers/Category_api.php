<?php 

class Category_api extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->output->set_content_type('application/json');
        $this->load->model('category_api_model');
        $_POST = json_decode(file_get_contents("php://input"), true);

    }


    public function get_all_datas(){

        $datas = $this->category_api_model->get_all(array(
            
            'array'     => true,
            'select'    => array(
                
                "category.id",
                "category.category_name",
                "users.full_name",
                "category.createdAt",
                "category.updatedAt",
                "category.deletedAt",
                "category.isActive",
            )

        ));
        echo "<pre>";
        print_r($datas);
        
    }

    public function save(){

        echo $this->category_api_model->add(array(

            "id"            => $this->input->post("id"),
            "category_name" => $this->input->post("category_name"),
            "user_id"       => $this->input->post("user_id"),
            "createdAt"     => $this->input->post("createdAt"),
            "updatedAt"     => $this->input->post("updatedAt"),
            "deletedAt"     => $this->input->post("deletedAt"),
            "isActive"      => $this->input->post("isActive")

        ));
        
    }

    public function update(){

        echo "Update İşlemi";
        
    }

    public function delete(){

        echo "Delete İşlemi";
        
    }



}