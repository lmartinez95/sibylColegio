<?php
    class Alumno extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('alumno_model');
            $this->load->helper('url_helper');
        }
        public function index($mensaje = NULL, $nivel = NULL){
            $data['results'] = $this->alumno_model->mostrar();
            $data['title'] = 'Alumnos';
            if (isset($mensaje) && isset($nivel)) {
                $data['mensaje'] = $mensaje;
                $data['nivel'] = $nivel;
            }
            $this->load->view('shared/header', $data);
            $this->load->view('alumno/index', $data);
        }

        public function agregar()
        {
            $data = array(
                'almNombre' => $_REQUEST['txtNombre'],
                'almApellidoP' => $_REQUEST['txtApellidoP'],
                'almApellidoM' => $_REQUEST['txtApellidoM'],
                'almFechaNac' => $_REQUEST['dtpFechaNac'],
                'almLugarNac' => $_REQUEST['txtLugarNac'],
                'almSexo' => $_REQUEST['cboSexo'],
                'almDireccion' => $_REQUEST['txtDireccion'],
                'almMadre' => $_REQUEST['txtMadre'],
                'almPadre' => $_REQUEST['txtPadre'],
                'almTelCasa' => $_REQUEST['txtTelCasa'],
                'almTelCel' => $_REQUEST['txtTelCel'],
                'almCorreo' => $_REQUEST['txtEmail'],
                'almResponsable' => $_REQUEST['txtResponsable'],
                'almTelResponsable' => $_REQUEST['txtTelResponsable'] );
            $b = $this->alumno_model->agregar($data);
            if (substr($b['codigo'],0,3) === TRUE) {
                $mensaje = "Registro agregado exitosamente. El codigo es ".substr($b['codigo'],4);
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
                $b = $this->alumno_model->eliminar($value);
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