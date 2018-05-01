<?php
    class Materia extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('materia_model');
            $this->load->helper('url_helper');
        }
        public function index($mensaje = NULL, $nivel = NULL){
            $data['results'] = $this->materia_model->mostrar();
            $data['title'] = 'Materias';
            if (isset($mensaje) && isset($nivel)) {
                $data['mensaje'] = $mensaje;
                $data['nivel'] = $nivel;
            }
            $this->load->view('shared/header', $data);
            $this->load->view('materia/index', $data);
        }

        public function agregar()
        {
            $data = array(
                'matCodigo' => $_REQUEST['txtCodigo'],
                'matNombre' => $_REQUEST['txtNombre'] );
            $b = $this->materia_model->agregar($data);
            if ($b === TRUE) {
                $mensaje = "Registro agregado exitosamente.";
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
                $b = $this->materia_model->eliminar($value);
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