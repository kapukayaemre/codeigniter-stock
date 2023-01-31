<?php

class Product extends CI_Controller {

    public $viewFolder = '';
    public function __construct(){

        parent::__construct();
        $this->viewFolder = 'product_view';
        $this->subViewFolder = 'list';

        echo $this->viewFolder;
        echo $this->subViewFolder;
        

    }

    public function index(){

        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = $this->subViewFolder;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

}