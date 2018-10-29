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
            $this->load->library('session');
            if ($this->session->userdata('permisos')) {
                # code...
            } else {
                # code...
            }
            
            $data['title'] = 'Docente';
            $data['content_view'] = 'docente/index';
            $data['results'] = $this->Docente_model->mostrar($this->session->userdata('empId'));
            $this->template->docente_dash($data);
        }

        public function agregar()
        {
            $data = array(
                'empId' => $_REQUEST['cboEmpId'],
                'matId' => $_REQUEST['cboMatId'],
                'nvlId' => $_REQUEST['cboNvlId']);
            $b = $this->Grupo_model->agregar($data);
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
            $data['alumno'] = $this->Grupo_model->cargaAlumno($grupo);
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
            
            $b = $this->Grupo_model->inscribir($data);
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
                $b = $this->Grupo_model->eliminar($value);
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