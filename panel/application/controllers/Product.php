<?php

class Product extends CI_Controller {
    public $viewFolder = '';

    public function __construct(){

        parent::__construct();
        $this->viewFolder = 'product_view';
        $this->load->model('product_model');

    }

    public function index(){

        $viewData = new stdClass();

        /* Veritabanındaki Tablodan Verilerin Getirilmesi */
        $items = $this->product_model->get_all();

        /* View'e Gönderilecek Verilerin Set Edilmesi */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'list';
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    /* Yeni Ürün Ekleme */
    public function new_form(){

        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'add';

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    /* Form Kontrolleri */
    public function save(){
        // Kütüphane çağırılır ->
        $this->load->library('form_validation');
        // Kurallar tanımlanır ->     // Parametre olarak formdaki name, başlık, kurallar
        $this->form_validation->set_rules('title', 'Başlık', 'required|trim');

        $this->form_validation->set_message(
            array(
                'required' => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );
        // Form Validation çalışır -> (True veya False değer döner.)
        $validate = $this->form_validation->run();
        
        // VERITABANINA KAYIT YOLLAMA
        if ($validate){
            $insert = $this->product_model->add(
                array(
                    'title'             => $this->input->post('title'),
                    'description'       => $this->input->post('description'),
                    'category_id'       => null,
                    'sub_category_id'   => null,
                    'user_id'           => null,
                    'createdAt'         => date('Y-m-d H:i:s'),
                    'updatedAt'         => null,
                    'deletedAt'         => null,
                    'isActive'          => 1
                )
            );
            if ($insert){
                redirect(base_url('product'));
            } else {
                redirect(base_url('product'));
            }


        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'add';
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
        

    }
    /* Güncelleme Formu */
    public function update_form($id){

        $viewData = new stdClass();

        // Veritabanındaki Tablodan Verilerin Getirilmesi

        $item = $this->product_model->get(
            array(
                "id" => $id

            )
        );

        // View'e Gönderileceklerin Set Edilmesi

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'update';
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function update($id){
        // Kütüphane çağırılır ->
        $this->load->library('form_validation');
        // Kurallar tanımlanır ->     // Parametre olarak formdaki name, başlık, kurallar
        $this->form_validation->set_rules('title', 'Başlık', 'required|trim');

        $this->form_validation->set_message(
            array(
                'required' => '<b>{field}</b> Alanını Doldurulmalıdır.'
            )
        );
        // Form Validation çalışır -> (True veya False değer döner.)
        $validate = $this->form_validation->run();

        // VERITABANINA KAYIT YOLLAMA
        if ($validate){
            $update = $this->product_model->update(

                array(
                    'id'    => $id
                ),

                array(
                    'title'             => $this->input->post('title'),
                    'description'       => $this->input->post('description'),
                    'category_id'       => null,
                    'sub_category_id'   => null
                    
                    
                )
            );
            // TODO Alert Sistemi Eklenecek
            if ($update){
                redirect(base_url('product'));
            } else {
                redirect(base_url('product'));
            }



        } else {
            $viewData = new stdClass();

            /* Tekrar View'e Yolladığımızda item değişkeni tanımlı olmadığı için hata verir.
             Bu sebepten dolayı bir view yüklerken tüm gereksinimleri karşılanmalıdır.!!! */
            $item = $this->product_model->get(
                array(
                    'id'    => $id
                )
            );


            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = 'update';
            $viewData->form_error = true;
            $viewData->item = $item;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function delete($id){
        $delete = $this->product_model->delete(
            array(
                'id'    => $id
            )
        );

        // TODO Alert Sistemi Eklenecek...
        
        if($delete) {

            redirect(base_url('product'));

        } else {
            redirect(base_url('product'));
        }
    }

    public function isActiveSetter($id){

        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->product_model->update(
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