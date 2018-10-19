<?php
    class Nivel extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Nivel_model');
        }
        public function index(){
            $this->load->library('complements');
            $data['title'] = 'Niveles';
            $data['content_view'] = 'admin/nivel/index';
            $data['nivel'] = $this->complements->cargaCombo('nvlId','nvlNivel','Nivel');
            $data['results'] = $this->Nivel_model->mostrar();
            $this->template->admin_dash($data);
        }

        public function agregar()
        {
            if ($this->input->post('btnAgregar')) {
                if (empty($this->input->post('cboNvlIdPadre'))) {
                    $data = array(
                        'nvlAbrev' => $_REQUEST['nvlAbrev'],
                        'nvlNivel' => $_REQUEST['nvlNivel']);
                } else {
                    $data = array(
                        'nvlAbrev' => $_REQUEST['nvlAbrev'],
                        'nvlNivel' => $_REQUEST['nvlNivel'],
                        'nvlIdPadre' => $this->input->post('cboNvlIdPadre') );
                }
                $b = $this->Nivel_model->agregar($data);
                if ($b === TRUE) {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro ingresado exitosamente</div>');
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> ' . $b . '</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Ingrese datos correctos</div>');
            }
            
            
            redirect('admin/nivel/');
        }

        public function eliminar($value = null)
        {
            if (isset($value) && !empty($value)) {
                $b = $this->Nivel_model->eliminar($value);
                if ($b === TRUE) {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro eliminado exitosamente</div>');
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-warning"><strong>¡Error!</strong> ' . $b . '</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Operación no válida</div>');
            }
            redirect('admin/nivel/');
        }
    }
    
?>