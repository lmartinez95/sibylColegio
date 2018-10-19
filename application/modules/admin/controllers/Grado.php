<?php
    class Grado extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Grado_model');
        }
        public function index($mensaje = NULL, $nivel = NULL){
            $this->load->library('complements');
            $data['results'] = $this->Grado_model->mostrar();
            $data['nivel'] = $this->complements->cargaCombo('nvlId','nvlNivel','Nivel');
            $data['empleado'] = $this->complements->cargaCombo('empId',"CONCAT(empNombre,' ',empApellidoP,' ',empApellidoM) AS nombre",'Empleado','tempId = 2');
            $data['turno'] = $this->complements->cargaCombo('turId','turNombre','Turno');            
            $data['title'] = 'Grados';
            $data['content_view'] = 'admin/grado/index';
            $this->template->admin_dash($data);
        }

        public function agregar()
        {
            if ($this->input->post('btnAgregar') !== NULL) {
                if(!empty($this->input->post('cboEmpId')) && !empty($this->input->post('cboNvlId')) && !empty('cboTurId')){
                    $data = array(
                        'grdNombre' => $this->input->post('txtgrdNombre'),
                        'turId' => $this->input->post('cboTurId'),
                        'empId' => $this->input->post('cboEmpId'),
                        'nvlId' => $this->input->post('cboNvlId'));
                    $b = $this->Grado_model->agregar($data);
                    if ($b === TRUE) {
                        $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Grupo creado exitosamente</div>');
                    } else {
                        $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> ' . $b . '</div>');
                    }
                }else{
                    $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Debe ingresar todos los datos solicitados</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Debe ingresar todos los datos solicitados</div>');
            }

            redirect('admin/grado/');
        }

        

        public function listado($grupo){
            $data['results'] = $this->Grupo_model->listado($grupo);
            $data['title'] = 'Detalle';
            $this->load->view('shared/header', $data);
            $this->load->view('grupo/listado', $data);
        }
    }    
?>