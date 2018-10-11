<?php
    class Empleado extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Empleado_model');
        }
        public function index(){
            $this->load->library('complements');
            $data['title'] = 'Empleados';
            $data['content_view'] = 'admin/empleado/index';
            $data['results'] = $this->Empleado_model->mostrar();
            $data['combo'] = $this->complements->cargaCombo('tempId','tempNombre','TipoEmpleado');
            $this->template->admin_dash($data);
        }

        public function agregar()
        {
            $data = array(
                'empNombre' => $this->input->post('txtNombre'),
                'empApellidoP' => $this->input->post('txtApellidoP'),
                'empApellidoM' => $this->input->post('txtApellidoM'),
                'empSexo' => $this->input->post('cboSexo'),
                'empDUI' => $this->input->post('txtDUI'),
                'empNIT' => $this->input->post('txtNIT'),
                'empISSS' => $this->input->post('txtISSS'),
                'empNUP' => $this->input->post('txtNUP'),
                'empDireccion' => $this->input->post('txtDireccion'),
                'empEmail' => $this->input->post('txtEmail'),
                'tempId' => $this->input->post('cboTempId') );
            $b = $this->Empleado_model->agregar($data);
            if ($b['status'] == TRUE) {
                $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro agregado exitosamente. El código es <strong>'. $b['value'] . '</strong></div>');
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> ' . $b['value'] . '</div>');
            }
            redirect('admin/empleado/');
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
            redirect('admin/empleado/');
        }
    }
    
?>