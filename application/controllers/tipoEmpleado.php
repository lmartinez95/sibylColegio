<?php
    class TipoEmpleado extends CI_Controller
    {
    public function __construct()
        {
            parent::__construct();
            $this->load->model('tipoEmpleado');
            $this->load->helper('url_helper');
        }
        public function index(){
            $data['results'] = $this->tipoEmpleado->mostrar();
            $data['title'] = 'Tipo de empleado';
            $this->load->view('shared/header', $data);
            $this->load->view('tipoEmpleado/index', $data);
        }
    }
    
?>