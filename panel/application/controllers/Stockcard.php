<?php

class Stockcard extends CI_Controller {
    public $viewFolder = '';

    public function __construct(){

        parent::__construct();
        $this->viewFolder = 'stockcard_view';
        $this->load->model('stockcard_model');

        if(!get_active_user()){
			redirect(base_url('login'));
		}

    }

    public function index(){

        $viewData = new stdClass();

        /* Veritabanındaki Tablodan Verilerin Getirilmesi */
        $items = $this->stockcard_model->get_all();

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
        $this->form_validation->set_rules('stockcard_title', 'Stok Kartı Başlık', 'required|trim');

        $this->form_validation->set_message(
            array(
                'required' => '<b>{field}</b> Alanı Doldurulmalıdır.'
            )
        );
        // Form Validation çalışır -> (True veya False değer döner.)
        $validate = $this->form_validation->run();
        
        // VERITABANINA KAYIT YOLLAMA
        if ($validate){
            $insert = $this->stockcard_model->add(
                array(
                    'stockcard_title'       => $this->input->post('stockcard_title'),
                    'category_id'           => null,
                    'sub_category_id'       => null,
                    'user_id'               => $this->session->user->id,
                    'createdAt'             => date('Y-m-d H:i:s'),
                    'isActive'              => 1
                )
            );
            if ($insert){

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
            //! İşlemin sonucunun sessiona aktarılması
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url('stockcard'));


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

        $item = $this->stockcard_model->get(
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
        $this->form_validation->set_rules('stockcard_title', 'Stok Kartı Başlık', 'required|trim');

        $this->form_validation->set_message(
            array(
                'required' => '<b>{field}</b> Alanını Doldurulmalıdır.'
            )
        );
        // Form Validation çalışır -> (True veya False değer döner.)
        $validate = $this->form_validation->run();

        // VERITABANINA KAYIT YOLLAMA
        if ($validate){
            $update = $this->stockcard_model->update(

                array(
                    'id'    => $id
                ),

                array(
                    'stockcard_title'       => $this->input->post('stockcard_title'),
                    'category_id'           => null,
                    'sub_category_id'       => null,
                    'user_id'               => $this->session->user->id,
                    'updatedAt'             => date('Y-m-d H:i:s')

                )
            );
            
            if ($update){

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
            redirect(base_url('stockcard'));

        } else {
            $viewData = new stdClass();

            /* Tekrar View'e Yolladığımızda item değişkeni tanımlı olmadığı için hata verir.
             Bu sebepten dolayı bir view yüklerken tüm gereksinimleri karşılanmalıdır.!!! */
            $item = $this->stockcard_model->get(
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
        $delete = $this->stockcard_model->delete(
            array(
                'id'    => $id
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
        redirect(base_url('stockcard'));
    }

    public function isActiveSetter($id){

        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->stockcard_model->update(
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