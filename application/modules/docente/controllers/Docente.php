<?php
    class Docente extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Docente_model');
        }
        public function index(){
            $data['title'] = 'Docente';
            if ($this->complements->veriAcceso('dashDocente')) {
                $data['content_view'] = 'docente/index';
                $data['results'] = $this->Docente_model->mostrar($this->session->userdata('empId'));
            } else
                $data['content_view'] = 'template/denied';
            $this->template->admin_dash($data);
        }

        function listado($grupo = NULL){
            if (!empty($grupo)) {
                $data['title'] = 'Listado';
                if ($this->complements->veriAcceso('dashDocente')) {
                    $data['content_view'] = 'docente/listado';
                    $data['results'] = $this->Docente_model->listado($grupo, $this->session->userdata('empId'));
                    if ($data['results'] == 0)
                        $data['content_view'] = 'template/denied';        
                } else
                    $data['content_view'] = 'template/denied';
                $this->template->admin_dash($data);
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
                $this->template->admin_dash($data);
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

        function autoEvaluacion()
        {
            $evaluaciones = $this->Docente_model->autoEvaluacion($this->input->get('term'));
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($evaluaciones, JSON_FORCE_OBJECT);
        }

        function addNota($grupo,$evaluacion){
            if (!empty($grupo)) {
                $data['title'] = 'Agregar nota';
                $data['content_view'] = 'docente/addNota';
                $data['grupo'] = $grupo;
                $data['evaluacion'] = $evaluacion;
                $data['results'] = $this->Docente_model->addNota($grupo,$evaluacion);
                $this->template->admin_dash($data);
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
                                'grpId' => $grupo,
                                'notPorcentaje' => ''
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