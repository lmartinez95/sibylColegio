<?php
    class Nivel extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('Complements');
            $this->load->model('Nivel_model');
        }
        public function index(){
            $data['title'] = 'Niveles';
            if ($this->complements->veriAcceso('verAlumno')) {
                $data['content_view'] = 'admin/nivel/index';
                $data['results'] = $this->Nivel_model->mostrar();
            } else
                $data['content_view'] = 'template/denied';
            $this->template->admin_dash($data);
        }

        public function create()
        {
            $data['title'] = 'Niveles';
            $data['content_view'] = 'admin/nivel/create';
            $data['nivel'] = $this->complements->cargaCombo('nvlId','nvlNivel','Nivel');
            $data['results'] = $this->Nivel_model->mostrar();
            $this->template->admin_dash($data);
        }

        public function agregar()
        {
            if ($this->input->method() === 'post') {
                $this->form_validation->set_rules('nvlAbrev', 'Abreviatura', 'trim|required|min_length[3]|max_length[10]');
                $this->form_validation->set_rules('nvlNivel', 'Nivel', 'trim|required|min_length[3]|max_length[25]');
                $this->form_validation->set_rules('nvlAbrev', 'Abreviatura', 'trim|required|numeric');
                if ($this->form_validation->run() === FALSE)
                {
                    $data['data'] = array();
                    $data['title'] = 'Niveles';
                    $data['content_view'] = 'admin/nivel/create';
                    $data['nivel'] = $this->complements->cargaCombo('nvlId','nvlNivel','Nivel');
                    $data['results'] = $this->Nivel_model->mostrar();
                    return $this->template->admin_dash($data);
                }
                else
                {
                    if ($this->input->post('cboNvlIdPadre') == 0) {
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
                        $this->session->set_flashdata('success','Nivel ingresado exitosamente');
                    } else {
                        $this->session->set_flashdata('danger',$b);
                    }
                }
            }
            
            return redirect('admin/nivel/');
        }

        public function eliminar($value = null)
        {
            if ($this->input->method() === "post") {
                if (isset($value) && !empty($value)) {
                    $b = $this->Nivel_model->eliminar($value);
                    if ($b === TRUE) {
                        $this->session->set_flashdata('success','Nivel eliminado exitosamente');
                    } else {
                        $this->session->set_flashdata('warning',$b);
                    }
                } else {
                    $this->session->set_flashdata('danger','Operación no válida');
                }
            }
            
            redirect('admin/nivel/');
        }
    }
    
?>