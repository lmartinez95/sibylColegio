<?php
    class Grupo extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Grupo_model');
            $this->load->helper('url_helper');
        }
        public function index($mensaje = NULL, $nivel = NULL){
            $data['results'] = $this->Grupo_model->mostrar();
            $data['empleado'] = $this->Grupo_model->cargaCombo('empId',"CONCAT(empNombre,' ',empApellidoP,' ',empApellidoM) AS nombre",'Empleado','tempId = 2');
            $data['materia'] = $this->Grupo_model->cargaCombo('matId','matNombre','Materia');
            $data['nivel'] = $this->Grupo_model->cargaCombo('nvlId','nvlNivel','Nivel');
            $data['title'] = 'Grupos';
            if (isset($mensaje) && isset($nivel)) {
                $data['mensaje'] = $mensaje;
                $data['nivel'] = $nivel;
            }
            $this->load->view('shared/header', $data);
            $this->load->view('grupo/index', $data);
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

        public function listado($grupo){
            $data['results'] = $this->Grupo_model->listado($grupo);
            $data['title'] = 'Detalle';
            $this->load->view('shared/header', $data);
            $this->load->view('grupo/listado', $data);
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