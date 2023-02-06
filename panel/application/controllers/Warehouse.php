<?php

class Warehouse extends CI_Controller {

    public $viewFolder = "";
    public function __construct() {
        
        parent::__construct();
        $this->viewFolder = 'warehouse_view';
        $this->load->model('warehouse_model');
        $this->load->model('user_model');
        

        if(!get_active_user()){
			redirect(base_url('login'));
		}
    
    }

    //! Listeleme icin viewe gönderilenler
    public function index(){

        $viewData = new stdClass();
        $datas = $this->warehouse_model->get_all(
            array(
                'array'     => true,
                'select'    => array(
                    "warehouse.id",
                    "warehouse.warehouse_name",
                    "city.city_id",
                    "city.city_name",
                    "town.town_id",
                    "town.town_name",
                    "users.full_name",
                    "warehouse.createdAt",
                    "warehouse.updatedAt",
                    "warehouse.deletedAt",
                    "warehouse.isActive",
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

        $datas_city = $this->warehouse_model->get_all_city(
            array(
                'array'     => true,
                'select'    => array(
                    "city.city_id as city_id",
                    "city.city_name as city_name"
                )
            )
        );

        $datas_town = $this->warehouse_model->get_all_town(
            array(
                'array'     => true,
                'select'    => array(
                    "town.town_id as town_id",
                    "town.town_name as town_name"
                )
            )
        );

        $viewData->datas_city = $datas_city;
        $viewData->datas_town = $datas_town;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'add';

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    //! Kategori Kayıt İçin Form Kontrolleri
    public function save(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('warehouse_name', 'Depo Adı', 'required|trim');
        $this->form_validation->set_message(
            array(
                'required' => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );

        $validate = $this->form_validation->run();

        //! Veritabanına Kayıt İşlemleri ve Kontrolleri

        if($validate) {
            $insert = $this->warehouse_model->add(
                array(
                    'warehouse_name'    => $this->input->post('warehouse_name'),
                    'city_id'           => $this->input->post('city_id'),
                    'town_id'           => $this->input->post('town_id'),
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
            redirect(base_url('warehouse/'));
        
        } else {

            $viewData = new stdClass();

            $datas_city = $this->warehouse_model->get_all_city(
                array(
                    'array'     => true,
                    'select'    => array(
                        "city.city_id as city_id",
                        "city.city_name as city_name"
                    )
                )
            );
    
            $datas_town = $this->warehouse_model->get_all_town(
                array(
                    'array'     => true,
                    'select'    => array(
                        "town.town_id as town_id",
                        "town.town_name as town_name"
                    )
                )
            );
    
            $viewData->datas_city = $datas_city;
            $viewData->datas_town = $datas_town;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'add';
            $viewData->form_error = true; //! Alertler İçin True olarak yönlendirildi.
            
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }        

    }

    public function update_form($id){

        $viewData = new stdClass();
        
        //! Veritabanından Güncellenecek Dosya 
        $item = $this->warehouse_model->get(
            array(
                'id' => $id
            )

        );

        $datas_city = $this->warehouse_model->get_all_city(
            array(
                'array'     => true,
                'select'    => array(
                    "city.city_id as city_id",
                    "city.city_name as city_name"
                )
            )
        );

        $datas_town = $this->warehouse_model->get_all_town(
            array(
                'array'     => true,
                'select'    => array(
                    "town.town_id as town_id",
                    "town.town_name as town_name"
                )
            )
        );

        //! View'e Gönderilecek Veriler
        $viewData->datas_city = $datas_city;
        $viewData->datas_town = $datas_town;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'update';
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update($id){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('warehouse_name', 'Kategori Adı', 'required|trim');
        $this->form_validation->set_rules('city_id', 'Şehir Adı', 'required|trim');
        $this->form_validation->set_rules('town_id', 'İlçe Adı', 'required|trim');
        $this->form_validation->set_message(
            array(
                'required'  => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {
            $update = $this->warehouse_model->update(
                array(
                    'id' => $id
                ),
                array(
                    'warehouse_name'    => $this->input->post('warehouse_name'),
                    'city_id'           => $this->input->post('city_id'),
                    'town_id'           => $this->input->post('town_id'),
                    'user_id'           => $this->session->user->id,
                    'updatedAt'         => date('Y-m-d H:i:s')
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
            redirect(base_url('warehouse'));
            
        } else {

            $viewData = new stdClass();

            $item = $this->warehouse_model->get(
                array(
                    'id' => $id
                )
            );

            $datas_city = $this->warehouse_model->get_all_city(
                array(
                    'array'     => true,
                    'select'    => array(
                        "city.city_id as city_id",
                        "city.city_name as city_name"
                    )
                )
            );
    
            $datas_town = $this->warehouse_model->get_all_town(
                array(
                    'array'     => true,
                    'select'    => array(
                        "town.town_id as town_id",
                        "town.town_name as town_name"
                    )
                )
            );
    
            $viewData->datas_city = $datas_city;
            $viewData->datas_town = $datas_town;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'update';
            $viewData->form_error = true;
            $viewData->item = $item;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }

    }

    public function delete($id) {
        $delete = $this->warehouse_model->delete(
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
        redirect(base_url('warehouse'));
    }

    //! Toggle
    public function isActiveSetter($id) {
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->warehouse_model->update(
                array(
                    'id' => $id
                ),
                array(
                    'isActive' => $isActive
                )
            );
        }
    }

    public function fetch_town($id){
        $townResult = $this->db->where('city_id',$id)->get('town')->result_array();
        echo json_encode($townResult);
    }





}