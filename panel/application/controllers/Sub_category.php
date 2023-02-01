<?php

class Sub_category extends CI_Controller {

    public $viewFolder = "";
    public function __construct() {
        
        parent::__construct();
        $this->viewFolder = 'sub_category_view';
        $this->load->model('sub_category_model');
    
    }

    //! Listeleme icin viewe gönderilenler
    public function index(){

        $viewData = new stdClass();
        $items = $this->sub_category_model->get_all();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'list';
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    //! Yeni Kategori Ekleme
    public function new_form(){

        $viewData = new stdClass();
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
                    'category_id'           => null,
                    'user_id'               => null,
                    'createdAt'             => date('Y-m-d H:i:s'),
                    'updatedAt'             => null,
                    'deletedAt'             => null,
                    'isActive'              => 1

                )
            );
            if ($insert) {
                redirect(base_url('sub_category'));
            } else {
                redirect(base_url('sub_category'));
            }
        
        } else {

            $viewData = new stdClass();
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

        //! View'e Gönderilecek Veriler
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
                    'sub_category_name' => $this->input->post('sub_category_name')
                )
            );

            if ($update) {
                redirect(base_url('sub_category'));
            } else {
                redirect(base_url('sub_category'));
            }
            
        } else {

            $viewData = new stdClass();

            $item = $this->sub_category_model->get(
                array(
                    'id' => $id
                )
            );

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
            )
        );

        if($delete) {
            redirect(base_url('sub_category'));
        } else {
            redirect(base_url('sub_category'));
        }
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