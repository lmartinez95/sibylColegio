<?php
    class Docente extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Docente_model');
            $this->load->library('complements');
        }
        public function index(){
            $data['title'] = 'Docente';
            $data['content_view'] = 'docente/index';
            $data['results'] = $this->Docente_model->mostrar($this->session->userdata('empId'));
            $this->template->docente_dash($data);
        }

        function listado($grupo = NULL){
            if (!empty($grupo)) {
                $data['title'] = 'Listado';
                $data['content_view'] = 'docente/listado';
                $data['results'] = $this->Docente_model->listado($grupo);
                $this->template->docente_dash($data);
            } else {
                echo 'error';
            }
        }

        function evaluacion($grupo = NULL){
            if (!empty($grupo)) {
                $data['title'] = 'Evaluaciones';
                $data['content_view'] = 'docente/evaluacion';
                $data['grupo'] = $grupo;
                $data['results'] = $this->Docente_model->evaluacion($grupo);
                $this->template->docente_dash($data);
            } else {
                echo 'error';
            }
        }

        function agregarEva($grupo){
            if (NULL !== $this->input->post('btnAgregar')) {
                if (!empty($this->input->post('txtEvaluacion')) && !empty($this->input->post('nudPorcentaje'))) {
                    $datos =  array(
                        'evaNombre' => $this->input->post('txtEvaluacion'),
                        'evaPorcentaje' => ($this->input->post('nudPorcentaje') / 100),
                        'grpId' => $grupo//$this->input->post('grpId')
                    );
                    $b = $this->Docente_model->agregarEva($datos);
                    if ($b === TRUE) {
                        $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro ingresado exitosamente</div>');
                    } else {
                        $this->session->set_flashdata('mensaje','<div class="alert alert-warning"><strong>¡Error!</strong> ' . $b . '</div>');
                    }
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-warning"><strong>¡Error!</strong> Debe ingresar los datos completos</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Operación no válida</div>');
            }
            redirect('docente/evaluacion/'.$grupo);
        }
    }
    
?>