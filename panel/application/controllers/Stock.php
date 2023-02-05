<?php

class Stock extends CI_Controller {

    public $viewFolder = "";
    public function __construct() {
        
        parent::__construct();
        $this->viewFolder = 'stock_view';
        $this->load->model('stock_model');
        $this->load->model('stockcard_model');
        $this->load->model('warehouse_model');
        $this->load->model('shelves_model');
        $this->load->model('user_model');


        if(!get_active_user()){
			redirect(base_url('login'));
		}
    
    }

    //! Listeleme icin viewe gönderilenler
    public function index(){
        
        $viewData = new stdClass();
        $datas = $this->stock_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "stock.id",
                    "stockcards.stockcard_title",
                    "warehouse.warehouse_name",
                    "shelves.shelves_name",
                    "stock.type",
                    "stock.total",
                    "users.full_name",
                    "stock.createdAt",
                    "stock.updatedAt",
                    "stock.deletedAt",
                    "stock.description",
                    "stock.isActive"

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

        $datas_stockcard = $this->stockcard_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "stockcards.id as stockcard_id",
                    "stockcards.stockcard_title as stockcard_name"
                )
            )
        );

        $datas_warehouse = $this->warehouse_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "warehouse.id as warehouse_id",
                    "warehouse.warehouse_name"
                )
            )
        );

        $datas_shelves = $this->shelves_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "shelves.id as shelves_id",
                    "shelves.shelves_name"
                )
            )
        );

        $viewData->datas_stockcard = $datas_stockcard;
        $viewData->datas_warehouse = $datas_warehouse;
        $viewData->datas_shelves = $datas_shelves;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'add';

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    //! Kategori Kayıt İçin Form Kontrolleri
    public function save(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'Açıklama', 'required|trim');
        $this->form_validation->set_rules('total', 'Stok Adeti', 'required|trim');
        $this->form_validation->set_message(
            array(
                'required' => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );

        $validate = $this->form_validation->run();

        //! Veritabanına Kayıt İşlemleri ve Kontrolleri

        if($validate) {
            $insert = $this->stock_model->add(
                array(
                    'stockcard_id'      => $this->input->post('stockcard_id'),
                    'warehouse_id'      => $this->input->post('warehouse_id'),
                    'shelves_id'        => $this->input->post('shelves_id'),
                    'type'              => $this->input->post('type'),
                    'total'             => $this->input->post('total'),
                    'user_id'           => $this->session->user->id,
                    'createdAt'         => date('Y-m-d H:i:s'),
                    'description'       => $this->input->post('description'),
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
            redirect(base_url('stock'));
        
        } else {

            $viewData = new stdClass();

            $datas_stockcard = $this->stockcard_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        "stockcards.id as stockcard_id",
                        "stockcards.stockcard_title as stockcard_name"
                    )
                )
            );

            $datas_warehouse = $this->warehouse_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        "warehouse.id as warehouse_id",
                        "warehouse.warehouse_name"
                    )
                )
            );

            $datas_shelves = $this->shelves_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        "shelves.id as shelves_id",
                        "shelves.shelves_name"
                    )
                )
            );

            $viewData->datas_stockcard = $datas_stockcard;
            $viewData->datas_warehouse = $datas_warehouse;
            $viewData->datas_shelves = $datas_shelves;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'add';
            $viewData->form_error = true; //! Alertler İçin True olarak yönlendirildi.

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }        

    }

    public function update_form($id){

        $viewData = new stdClass();
        
        //! Veritabanından Güncellenecek Dosya 
        $item = $this->stock_model->get(
            array(
                'id' => $id
            )
        );

        $datas_stockcard = $this->stockcard_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "stockcards.id as stockcard_id",
                    "stockcards.stockcard_title as stockcard_name"
                )
            )
        );

        $datas_warehouse = $this->warehouse_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "warehouse.id as warehouse_id",
                    "warehouse.warehouse_name"
                )
            )
        );

        $datas_shelves = $this->shelves_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "shelves.id as shelves_id",
                    "shelves.shelves_name"
                )
            )
        );

        //! View'e Gönderilecek Veriler
        $viewData->datas_stockcard = $datas_stockcard;
        $viewData->datas_warehouse = $datas_warehouse;
        $viewData->datas_shelves = $datas_shelves;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'update';
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update($id){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'Açıklama', 'required|trim');
        $this->form_validation->set_rules('total', 'Stok Adeti', 'required|trim');
        $this->form_validation->set_message(
            array(
                'required'  => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {
            $update = $this->stock_model->update(
                array(
                    'id' => $id
                ),
                array(
                    'stockcard_id'      => $this->input->post('stockcard_id'),
                    'warehouse_id'      => $this->input->post('warehouse_id'),
                    'shelves_id'        => $this->input->post('shelves_id'),
                    'type'              => $this->input->post('type'),
                    'total'             => $this->input->post('total'),
                    'user_id'           => $this->session->user->id,
                    'updatedAt'         => date('Y-m-d H:i:s'),
                    'description'       => $this->input->post('description'),
                    'isActive'          => 1

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
            redirect(base_url('stock'));
            
        } else {

            $viewData = new stdClass();

            $item = $this->stock_model->get(
                array(
                    'id' => $id
                )
            );

            $datas_stockcard = $this->stockcard_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        "stockcards.id as stockcard_id",
                        "stockcards.stockcard_title as stockcard_name"
                    )
                )
            );

            $datas_warehouse = $this->warehouse_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        "warehouse.id as warehouse_id",
                        "warehouse.warehouse_name"
                    )
                )
            );

            $datas_shelves = $this->shelves_model->get_all(
                array(
                    'array'     => true,
                    'select'    => array(
                        "shelves.id as shelves_id",
                        "shelves.shelves_name"
                    )
                )
            );

            //! View'e Gönderilecek Veriler
            $viewData->datas_stockcard = $datas_stockcard;
            $viewData->datas_warehouse = $datas_warehouse;
            $viewData->datas_shelves = $datas_shelves;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'update';
            $viewData->form_error = true;
            $viewData->item = $item;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }

    }

    public function delete($id) {
        $delete = $this->stock_model->delete(
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
        redirect(base_url('stock'));
    }

    //! Toggle
    public function isActiveSetter($id) {
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->stock_model->update(
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