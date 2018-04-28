<?php
    class Nivel extends CI_Controller
    {
    public function __construct()
        {
            parent::__construct();
            $this->load->model('nivel_model');
            $this->load->helper('url_helper');
        }
        public function index(){
            $data['results'] = $this->nivel_model->mostrar();
            $data['title'] = 'Niveles de estudio';
            $this->load->view('shared/header', $data);
            $this->load->view('nivel/index', $data);
        }

        public function agregar()
        {
            $data = array(
                'nvlAbrev' => $_REQUEST['nvlAbrev'],
                'nvlNivel' => $_REQUEST['nvlNivel'] );
            $this->nivel_model->agregar($data);
            redirect(base_url('index.php/nivel/'));
        }
    }
    
?>