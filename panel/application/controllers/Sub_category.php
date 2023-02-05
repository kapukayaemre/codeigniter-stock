<?php

class Sub_category extends CI_Controller {

    public $viewFolder = "";
    public function __construct() {
        
        parent::__construct();
        $this->viewFolder = 'sub_category_view';
        $this->load->model('sub_category_model');
        $this->load->model('category_model');

        if(!get_active_user()){
			redirect(base_url('login'));
		}
    
    }

    //! Listeleme icin viewe gönderilenler
    public function index(){

        $viewData = new stdClass();
        $datas = $this->sub_category_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "sub_category.id",
                    "sub_category.sub_category_name",
                    "category.category_name",
                    "users.full_name",
                    "sub_category.createdAt",
                    "sub_category.updatedAt",
                    "sub_category.deletedAt",
                    "sub_category.isActive"
                )
            )
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'list';
        $viewData->datas = $datas;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    //! Yeni Kategori Ekleme Arayüzü
    public function new_form(){

        $viewData = new stdClass();

        $datas_main_category = $this->category_model->get_all(
            array(
                'array' => true,
                'select' => array(
                    "category.id as category_id",
                    "category.category_name"
                )
            )
        );

        $viewData->datas_main_category = $datas_main_category;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'add';
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    //! Kategori Kayıt İçin Form Kontrolleri
    public function save(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('sub_category_name', 'Alt Kategori Adı', 'required|trim');
        $this->form_validation->set_message(
            array(
                'required' => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );

        $validate = $this->form_validation->run();

        //! Veritabanına Kayıt İşlemleri ve Kontrolleri

        if($validate) {
            $insert = $this->sub_category_model->add(
                array(
                    'sub_category_name'     => $this->input->post('sub_category_name'),
                    'category_id'           => $this->input->post('category_id'),
                    'user_id'               => $this->session->user->id,
                    'createdAt'             => date('Y-m-d H:i:s'),
                    'isActive'              => 1

                )
            );
            if ($insert) {

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "message"  => "Kayıt Başarılı Bir Şekilde Eklendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "message"  => "Kayıt Eklerken Bir Hata Oluştu",
                    "type"  => "error"
                );
               
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('sub_category'));
        
        } else {

            $viewData = new stdClass();

            $datas_main_category = $this->category_model->get_all(
                array(
                    'array' => true,
                    'select' => array(
                        "category.id as category_id",
                        "category.category_name"
                    )
                )
            );


            $viewData->datas_main_category = $datas_main_category;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'add';
            $viewData->form_error = true; //! Alertler İçin True olarak yönlendirildi.

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }        

    }

    public function update_form($id){

        $viewData = new stdClass();
        
        //! Veritabanından Güncellenecek Dosya 
        $item = $this->sub_category_model->get(
            array(
                'id' => $id
            )

        );

        $datas_main_category = $this->category_model->get_all(
            array(
                'array' => true,
                'select' => array(
                    "category.id as category_id",
                    "category.category_name"
                )
            )
        );

        //! View'e Gönderilecek Veriler
        $viewData->datas_main_category = $datas_main_category;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'update';
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update($id){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('sub_category_name', 'Alt Kategori Adi', 'required|trim');
        $this->form_validation->set_message(
            array(
                'required'  => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {
            $update = $this->sub_category_model->update(
                array(
                    'id' => $id
                ),
                array(
                    'sub_category_name' => $this->input->post('sub_category_name'),
                    'category_id'       => $this->input->post('category_id'),
                    'user_id'           => $this->session->user->id,
                    'updatedAt'         => date('Y-m-d H:i:s'),
                    'isActive'          =>  1
                )
            );

            if ($update) {

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "message"  => "Kayıt Başarılı Bir Şekilde Güncellendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "message"  => "Güncelleme Sırasında Hata Oluştu",
                    "type"  => "error"
                );
                
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('sub_category'));
            
        } else {

            $viewData = new stdClass();

            $item = $this->sub_category_model->get(
                array(
                    'id' => $id
                )
            );

            $datas_main_category = $this->category_model->get_all(
                array(
                    'array' => true,
                    'select' => array(
                        "category.id as category_id",
                        "category.category_name"
                    )
                )
            );


            $viewData->datas_main_category = $datas_main_category;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'update';
            $viewData->form_error = true;
            $viewData->item = $item;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }

    }

    public function delete($id) {
        $delete = $this->sub_category_model->delete(
            array(
                'id' => $id
            ),
            array(
                'deletedAt' => date('Y-m-d H:i:s'),
                'user_id'   => $this->session->user->id
            )
        );

        if($delete) {
            
            $alert = array(
                "title" => "İşlem Başarılı",
                "message"  => "Kayıt Başarılı Bir Şekilde Silindi",
                "type"  => "success"
            );
            
        } else {

            $alert = array(
                "title" => "İşlem Başarısız",
                "message"  => "Silme İşlemi Sırasında Hata Oluştu",
                "type"  => "error"
            );
            
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url('sub_category'));
    }

    //! Toggle
    public function isActiveSetter($id){

        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->sub_category_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }

    }

    


}