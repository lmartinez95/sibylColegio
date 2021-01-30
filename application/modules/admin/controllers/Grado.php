<?php
    class Grado extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('Complements');
            $this->load->model('Grado_model');
        }
        public function index(){
            if ($this->complements->veriAcceso('verGrado')) {
                $data['results'] = $this->Grado_model->mostrar();
                $data['nivel'] = $this->complements->cargaCombo('nvlId','nvlNivel','Nivel');
                $data['empleado'] = $this->complements->cargaCombo('empId',"CONCAT(empNombre,' ',empApellidoP,' ',empApellidoM) AS nombre",'Empleado','tempId = 2');
                $data['turno'] = $this->complements->cargaCombo('turId','turNombre','Turno');            
                $data['title'] = 'Grados';
                $data['content_view'] = 'admin/grado/index';
            } else
                $data['content_view'] = 'template/denied';
            $this->template->admin_dash($data);
        }

        public function agregar()
        {
            if ($this->input->method() === 'POST') {
                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('warning','Debe ingresar todos los datos');
                    redirect('admin/grado/');
                }
                else
                {
                    $data = array(
                        'grdNombre' => $this->input->post('txtgrdNombre'),
                        'turId' => $this->input->post('cboTurId'),
                        'empId' => $this->input->post('cboEmpId'),
                        'nvlId' => $this->input->post('cboNvlId'));
                    $b = $this->Grado_model->agregar($data);
                    if ($b === TRUE) {
                        $this->session->set_flashdata('success','Grupo creado exitosamente');
                    } else {
                        $this->session->set_flashdata('danger',$b);
                    }
                }
            }

            redirect('admin/grado/');
        }
        
        public function editar($id = NULL)
        {
            if (condition) {
                # code...
            } else {
                # code...
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