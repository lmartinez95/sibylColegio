<?php
    class Template extends MY_Controller
    {
        function __construct(){
            parent::__construct();
        }

        function admin_dash($data = NULL){
            $data['usuario'] = $this->session->userdata('usuario');
            $this->load->view('template',$data);
        }

        function docente_dash($data = NULL){
            $data['usuario'] = $this->session->userdata('usuario');
            $this->load->view('tempDocente',$data);
        }
        function alumno_dash($data = NULL){
            $data['usuario'] = $this->session->userdata('usuario');
            $this->load->view('tempAlumno',$data);
        }

        function denied(){
            $this->load->view('denied');
        }
    }
    
?>