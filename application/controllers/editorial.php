<?php
    class Editorial extends CI_Controller
    {
    public function __construct()
        {
            parent::__construct();
            $this->load->model('editorial_model');
            $this->load->helper('url_helper');
        }
        public function index(){
            $data['results'] = $this->editorial_model->mostrar();
            $data['title'] = 'Editoriales';
            $this->load->view('shared/header', $data);
            $this->load->view('editorial/index', $data);
        }
    }
    
?>