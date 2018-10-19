<?php
    class Materia extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Materia_model');
        }
        public function index(){
            $data['title'] = 'Materias';
            $data['content_view'] = 'admin/materia/index';
            $data['results'] = $this->Materia_model->mostrar();
            $this->template->admin_dash($data);
        }

        public function agregar()
        {
            if ($this->input->post('btnAgregar')) {
                $data = array(
                    'matCodigo' => $_REQUEST['txtCodigo'],
                    'matNombre' => $_REQUEST['txtNombre'] );
                $b = $this->Materia_model->agregar($data);
                if ($b === TRUE) {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro ingresado exitosamente</div>');
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> ' . $b . '</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Ingrese los datos correctos</div>');
            }
            
            
            redirect('admin/materia/');
        }

        public function eliminar($value = null)
        {
            if (isset($value) && !empty($value)) {
                $b = $this->Materia_model->eliminar($value);
                if ($b === TRUE) {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro eliminado exitosamente</div>');
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-warning"><strong>¡Error!</strong> ' . $b . '</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Operación no válida</div>');
            }
            redirect('admin/materia/');
        }
    }
    
?>