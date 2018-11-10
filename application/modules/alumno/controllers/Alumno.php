<?php
    class Alumno extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Alumno_model');
            $this->load->library('session');
        }
        public function index(){
            $datos = $this->Alumno_model->mostrar($this->session->userdata('almId'));
            $datos['codigo'] = $this->session->userdata('codigo');
            $datos['nombre'] = $this->session->userdata('usuario');
            $data['title'] = 'Alumno';
            $data['content_view'] = 'alumno/index';
            $data['results'] = $datos;
            $this->template->alumno_dash($data);
        }

        function nota(){
            $data['title'] = 'Notas';
            $data['content_view'] = 'alumno/nota';
            $data['alm'] = $this->session->userdata('almId');
            $data['results'] = $this->Alumno_model->nota($this->session->userdata('almId'));
            $this->template->alumno_dash($data);
        }

        function detNota(){
            if (!empty($this->input->post('grp')) && !empty($this->input->post('alm'))) {
                $grp = $this->input->post('grp');
                $alm = $this->input->post('alm');
                $query = $this->Alumno_model->detNota($grp, $alm);
                $data = array();
                if (!empty($query)) {
                    $data['status'] = true;
                    $data['data'] = $query;
                } else {
                    $data['status'] = false;
                }
            } else {
                $data['status'] = false;
            }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($data, JSON_FORCE_OBJECT);
        }
    }
    
?>