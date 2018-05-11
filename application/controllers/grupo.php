<?php
    class Grupo extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('grupo_model');
            $this->load->helper('url_helper');
        }
        public function index($mensaje = NULL, $nivel = NULL){
            $data['results'] = $this->grupo_model->mostrar();
            $data['empleado'] = $this->grupo_model->cargaCombo('empId',"CONCAT(empNombre,' ',empApellidoP,' ',empApellidoM) AS nombre",'Empleado');
            $data['materia'] = $this->grupo_model->cargaCombo('matId','matNombre','Materia');
            $data['nivel'] = $this->grupo_model->cargaCombo('nvlId','nvlNivel','Nivel');
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
                'empNombre' => $_REQUEST['txtNombre'],
                'empApellidoP' => $_REQUEST['txtApellidoP'],
                'empApellidoM' => $_REQUEST['txtApellidoM'],
                'empSexo' => $_REQUEST['cboSexo'],
                'empDUI' => $_REQUEST['txtDUI'],
                'empNIT' => $_REQUEST['txtNIT'],
                'empISSS' => $_REQUEST['txtISSS'],
                'empNUP' => $_REQUEST['txtNUP'],
                'empDireccion' => $_REQUEST['txtDireccion'],
                'empEmail' => $_REQUEST['txtEmail'],
                'tempId' => $_REQUEST['cboTempId'] );
            $b = $this->grupo_model->agregar($data);
            if (substr($b,0,3) === TRUE) {
                $mensaje = "Registro agregado exitosamente. El codigo es ".substr($b,4);
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