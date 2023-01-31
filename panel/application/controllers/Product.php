<?php

class Product extends CI_Controller {

    public $viewFolder = '';
    public function __construct(){

        parent::__construct();
        $this->viewFolder = 'product_view';
        $this->load->model('product_model');

    }

    public function index(){

        /* Veritabanındaki Tablodan Verilerin Getirilmesi */
        $items = $this->product_model->get_all();

        /* View'e Gönderilecek Verilerin Set Edildiği Bölüm */
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = 'list';
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

}