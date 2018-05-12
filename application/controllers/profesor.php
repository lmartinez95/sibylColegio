<?php
    class Profesor extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('profesor_model');
            $this->load->helper('url_helper');
        }
        public function index($mensaje = NULL, $nivel = NULL){
            $data['results'] = $this->profesor_model->mostrar($this->session->userdata('codigo'));
            $data['title'] = 'Profesor';
            if (isset($mensaje) && isset($nivel)) {
                $data['mensaje'] = $mensaje;
                $data['nivel'] = $nivel;
            }
            $this->load->view('shared/header', $data);
            $this->load->view('profesor/index', $data);
        }

        public function agregar()
        {
            $data = array(
                'empId' => $_REQUEST['cboEmpId'],
                'matId' => $_REQUEST['cboMatId'],
                'nvlId' => $_REQUEST['cboNvlId']);
            $b = $this->grupo_model->agregar($data);
            if ($b === TRUE) {
                $mensaje = "Registro agregado exitosamente.";
                $nivel = 'success';
            } else {
                $mensaje = $b;
                $nivel = 'warning';
            }
            $this->index($mensaje,$nivel);
        }

        public function addAlumno($grupo)
        {
            $data['alumno'] = $this->grupo_model->cargaAlumno($grupo);
            $data['grupo'] = $grupo;
            $data['title'] = 'Agregar alumnos';
            $this->load->view('shared/header', $data);
            $this->load->view('grupo/addAlumno', $data);
        }

        public function inscribir()
        {
            $grupo = $_REQUEST['grupo'];
            $opciones = explode(',',$_REQUEST['alumno']);
            $data = array();
            for ($i=0; $i < count($opciones); $i++) { 
                array_push($data,
                    array(
                        'grpId' => $grupo,
                        'almId' => $opciones[$i]
                    )
                );
            }
            
            $b = $this->grupo_model->inscribir($data);
            if ($b === TRUE) {
                $mensaje = "Registros agregado exitosamente.";
                $nivel = 'success';
            } else {
                $mensaje = $b;
                $nivel = 'warning';
            }
            $this->index($mensaje,$nivel);
        }

        public function eliminar($value = null)
        {
            if (isset($value)) {
                $b = $this->grupo_model->eliminar($value);
                if ($b === TRUE) {
                    $mensaje = "Registro eliminado exitosamente.";
                    $nivel = 'success';
                } else {
                    $mensaje = $b;
                    $nivel = 'warning';
                }
                
            } else {
                $mensaje = "Operación no válida";
                    $nivel = 'danger';
            }
            $this->index($mensaje,$nivel);
            
        }
    }
    
?>