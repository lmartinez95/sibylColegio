<?php
    class Nivel extends CI_Controller
    {
    public function __construct()
        {
            parent::__construct();
            $this->load->model('nivel');
            $this->load->helper('url_helper');
        }
        public function index(){
            $data['results'] = $this->tipoEmpleado->mostrar();
            $data['title'] = 'Niveles de estudio';
            $this->load->view('shared/header', $data);
            $this->load->view('nivel/index', $data);
        }
    }
    
?>