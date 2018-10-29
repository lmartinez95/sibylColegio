<?php
    class Template extends MY_Controller
    {
        function __construct(){
            parent::__construct();
        }

        function admin_dash($data = NULL){
            $this->load->view('template',$data);
        }

        function docente_dash($data = NULL){
            $data['usuario'] = $this->session->userdata('usuario');
            $this->load->view('tempDocente',$data);
        }
    }
    
?>