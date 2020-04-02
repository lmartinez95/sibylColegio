<?php
    class TipoEmpleado extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('TipoEmpleado_model');
        }
        public function index(){
            $data['title'] = 'Tipo de empleados';
            if ($this->complements->veriAcceso('verTipoEmpleado')) {
                $data['content_view'] = 'admin/tipoEmpleado/index';
                $data['results'] = $this->TipoEmpleado_model->mostrar();
            } else
                $data['content_view'] = 'template/denied';
            $this->template->admin_dash($data);
        }

        public function agregar()
        {
            $data = array(
                'tempCodigo' => $this->input->post('txtTempCodigo'),
                'tempNombre' => $this->input->post('txtTempNombre') );
            $b = $this->TipoEmpleado_model->agregar($data);
            if ($b === TRUE) {
                $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro ingresado exitosamente</div>');
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> ' . $b . '</div>');
            }
            redirect('admin/tipoEmpleado/');
        }

        public function eliminar($value = null)
        {
            if (isset($value) && !empty($value)) {
                $b = $this->TipoEmpleado_model->eliminar($value);
                if ($b === TRUE) {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro eliminado exitosamente</div>');
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-warning"><strong>¡Error!</strong> ' . $b . '</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Operación no válida</div>');
            }
            redirect('admin/tipoEmpleado/');
        }
    }
    
?>