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
            $this->load->library('form_validation');
            if ($this->input->post('btnAgregar')) {
                $rules = array(
                    array(
                        'field' => 'txtCodigo',
                        'label' => 'Codigo',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => 'Debes ingresar un código de materia.',
                        ),
                    ),
                    array(
                        'field' => 'txtNombre',
                        'label' => 'Materia',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => 'Debes ingresar un nombre de materia.',
                        ),
                    ),
                );
                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == TRUE) {
                    $data = array(
                        'matCodigo' => $_REQUEST['txtCodigo'],
                        'matNombre' => $_REQUEST['txtNombre'] );
                    $b = $this->Materia_model->agregar($data);
                    if ($b === TRUE) {
                        $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro ingresado exitosamente</div>');
                        redirect('admin/materia/');
                    } else {
                        $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> ' . $b . '</div>');
                        $this->index();
                    }
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Ingrese los datos correctamente</div>');
                    $this->index();
                }
                
                
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Operación incorrecta</div>');
                redirect('admin/materia/');
            }
            
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