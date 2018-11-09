<?php
    class Alumno extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Alumno_model');
            $this->load->library('complements');
        }
        public function index(){
            $data['title'] = 'Alumno';
            $data['content_view'] = 'alumno/index';
            $data['results'] = $this->Alumno_model->mostrar($this->session->userdata('almId'));
            $this->template->alumno_dash($data);
        }

        function listado($grupo = NULL){
            if (!empty($grupo)) {
                $data['title'] = 'Listado';
                $data['content_view'] = 'docente/listado';
                $data['results'] = $this->Docente_model->listado($grupo);
                $this->template->docente_dash($data);
            } else {
                redirect(base_url() . 'docente');
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
                redirect(base_url() . 'docente');
            }
        }

        function agregarEva($grupo){
            if (NULL !== $this->input->post('btnAgregar')) {
                if (!empty($this->input->post('txtEvaluacion')) && !empty($this->input->post('nudPorcentaje'))) {
                    $datos =  array(
                        'evaNombre' => $this->input->post('txtEvaluacion'),
                        'evaPorcentaje' => ($this->input->post('nudPorcentaje') / 100),
                        'grpId' => $grupo
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

        function addNota($grupo,$evaluacion){
            if (!empty($grupo)) {
                $data['title'] = 'Agregar nota';
                $data['content_view'] = 'docente/addNota';
                $data['grupo'] = $grupo;
                $data['evaluacion'] = $evaluacion;
                $data['results'] = $this->Docente_model->addNota($grupo,$evaluacion);
                $this->template->docente_dash($data);
            } else {
                redirect(base_url() . 'docente');
            }
        }

        function cuNota($grupo,$evaluacion){
            if (NULL !== $this->input->post('btnGuardar')) {
                if (!empty($this->input->post('notas'))) {
                    $notas = $this->input->post('notas');
                    $arrInsert = array(); $arrUpdate = array();
                    foreach ($notas as $key => $value) {
                        foreach ($value as $k => $v) {
                            //echo 'notId = ' . $key .', almId = ' . $k . ', nota = ' . $v . '<br>' ;
                            $data =  array(
                                'notNota' => $v,
                                'evaId' => $evaluacion,
                                'almId' => $k,
                                'grpId' => $grupo
                            );
                            if ($key == 0) { //insert
                                //$b = $this->Docente_model->cuNota($datos, true);
                                array_push($arrInsert, $data);
                            } else { //update
                                $data['notId'] = $key;
                                //$b = $this->Docente_model->cuNota($datos, false);
                                array_push($arrUpdate, $data);
                            }
                            
                        }
                    }
                    $b = $this->Docente_model->cuNota($arrInsert,$arrUpdate);
                    
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