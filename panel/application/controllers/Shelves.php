<?php

class Shelves extends CI_Controller {

    public $viewFolder = "";
    public function __construct() {
        
        parent::__construct();
        $this->viewFolder = 'shelves_view';
        $this->load->model('shelves_model');
        $this->load->model('warehouse_model');
        $this->load->model('product_model');
        $this->load->model('user_model');

        if(!get_active_user()){
			redirect(base_url('login'));
		}
    
    }

    //! Listeleme icin viewe gönderilenler
    public function index(){

        $viewData = new stdClass();
        $datas = $this->shelves_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    'shelves.id',
                    'shelves.shelves_name',
                    'warehouse.warehouse_name',
                    'products.title',
                    'users.full_name',
                    'shelves.createdAt',
                    'shelves.updatedAt',
                    'shelves.deletedAt',
                    'shelves.isActive'
                )
            )
        );

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'list';
        $viewData->datas = $datas;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    //! Yeni Kategori Ekleme
    public function new_form(){

        $viewData = new stdClass();

        $datas_warehouse = $this->warehouse_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    'warehouse.id as warehouse_id',
                    'warehouse.warehouse_name as warehouse_name'
                )
            )
        );

        $datas_product = $this->product_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    'products.id as product_id',
                    'products.title as product_name'
                )
            )
        );

        $viewData->datas_warehouse = $datas_warehouse;
        $viewData->datas_product = $datas_product;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'add';

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    //! Kategori Kayıt İçin Form Kontrolleri
    public function save(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('shelves_name', 'Raf Adı', 'required|trim');
        $this->form_validation->set_message(
            array(
                'required' => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );

        $validate = $this->form_validation->run();

        //! Veritabanına Kayıt İşlemleri ve Kontrolleri

        if($validate) {
            $insert = $this->shelves_model->add(
                array(
                    'shelves_name'      => $this->input->post('shelves_name'),
                    'warehouse_id'      => $this->input->post('warehouse_id'),
                    'product_id'        => $this->input->post('product_id'),
                    'user_id'           => $this->session->user->id,
                    'createdAt'         => date('Y-m-d H:i:s'),
                    'isActive'          => 1

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
            redirect(base_url('shelves'));
        
        } else {

            $viewData = new stdClass();

            $datas_warehouse = $this->warehouse_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        'warehouse.id as warehouse_id',
                        'warehouse.warehouse_name as warehouse_name'
                    )
                )
            );

            $datas_product = $this->product_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        'products.id as product_id',
                        'products.title as product_name'
                    )
                )
            );

            $viewData->datas_warehouse = $datas_warehouse;
            $viewData->datas_product = $datas_product;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'add';
            $viewData->form_error = true; //! Alertler İçin True olarak yönlendirildi.

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }        

    }

    public function update_form($id){

        $viewData = new stdClass();
        
        //! Veritabanından Güncellenecek Dosya 
        $item = $this->shelves_model->get(
            array(
                'id' => $id
            )
        );

        $datas_warehouse = $this->warehouse_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    'warehouse.id as warehouse_id',
                    'warehouse.warehouse_name as warehouse_name'
                )
            )
        );

        $datas_product = $this->product_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    'products.id as product_id',
                    'products.title as product_name'
                )
            )
        );

        $viewData->datas_warehouse = $datas_warehouse;
        $viewData->datas_product = $datas_product;

        //! View'e Gönderilecek Veriler
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'update';
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update($id){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('shelves_name', 'Raf Adi', 'required|trim');
        $this->form_validation->set_message(
            array(
                'required'  => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {
            $update = $this->shelves_model->update(
                array(
                    'id' => $id
                ),
                array(
                    'shelves_name'  => $this->input->post('shelves_name'),
                    'warehouse_id'  => $this->input->post('warehouse_id'),
                    'product_id'    => $this->input->post('product_id'),
                    'user_id'       => $this->session->user->id,
                    'updatedAt'     => date('Y-m-d H:i:s'),
                    'isActive'      => 1
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
            redirect(base_url('shelves'));
        } else {

            $viewData = new stdClass();

            $item = $this->shelves_model->get(
                array(
                    'id' => $id
                )
            );

            $datas_warehouse = $this->warehouse_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        'warehouse.id as warehouse_id',
                        'warehouse.warehouse_name as warehouse_name'
                    )
                )
            );

            $datas_product = $this->product_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        'products.id as product_id',
                        'products.title as product_name'
                    )
                )
            );

            $viewData->datas_warehouse = $datas_warehouse;
            $viewData->datas_product = $datas_product;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'update';
            $viewData->form_error = true;
            $viewData->item = $item;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }

    }

    public function delete($id) {
        $delete = $this->shelves_model->delete(
            array(
                'id' => $id
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
        redirect(base_url('shelves'));
    }

    //! Toggle
    public function isActiveSetter($id) {
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->shelves_model->update(
                array(
                    'id' => $id
                ),
                array(
                    'isActive' => $isActive
                )
            );
        }
    }


}