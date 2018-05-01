<?php
    class Empleado extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('empleado_model');
            $this->load->helper('url_helper');
        }
        public function index($mensaje = NULL, $nivel = NULL){
            $data['results'] = $this->empleado_model->mostrar();
            $data['combo'] = $this->empleado_model->cargaCombo();
            $data['title'] = 'Empleados';
            if (isset($mensaje) && isset($nivel)) {
                $data['mensaje'] = $mensaje;
                $data['nivel'] = $nivel;
            }
            $this->load->view('shared/header', $data);
            $this->load->view('empleado/index', $data);
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
            $b = $this->empleado_model->agregar($data);
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
                $b = $this->empleado_model->eliminar($value);
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