<?php
    class Alumno extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('Complements');
            $this->load->model('Alumno_model');
        }

        public function index(){
            $data['title'] = 'Alumnos';
            if ($this->complements->veriAcceso('verAlumno')) {
                $data['content_view'] = 'admin/alumno/index';
                $data['results'] = $this->Alumno_model->mostrar();
            } else
                $data['content_view'] = 'template/denied';
            $this->template->admin_dash($data);
        }

        public function matricula(){
            $data['title'] = 'Matricula Alumnos';
            if ($this->complements->veriAcceso('matricula')) {
                $data['content_view'] = 'admin/alumno/matricula';
                $data['grado'] = $this->complements->cargaCombo('grdId','grdNombre','Grado');
                $data['departamento'] = $this->complements->cargaCombo('dptId','dptNombre','Departamento');
            }else
                $data['content_view'] = 'template/denied';
            $this->template->admin_dash($data);
        }

        function buscaAlumno(){
            if(!empty($this->input->post('txtBuscar'))){
                $result = $this->Alumno_model->buscaAlumno($this->input->post('txtBuscar'));
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($result, JSON_FORCE_OBJECT);
            }  
        }


        public function agregar()
        {
            if ($this->input->post('btnAgregarN')) {
                $data = array(
                    'almNie' => $this->input->post('txtNie'),
                    'almNombre' => $this->input->post('txtNombre'),
                    'almApellidoP' => $this->input->post('txtApellidoP'),
                    'almApellidoM' => $this->input->post('txtApellidoM'),
                    'almFechaNac' => $this->input->post('dtpFechaNac'),
                    'almLugarNac' => $this->input->post('txtLugarNac'),
                    'almSexo' => $this->input->post('cboSexo'),
                    'almDireccion' => $this->input->post('txtDireccion'),
                    'almMadre' => $this->input->post('txtMadre'),
                    'almPadre' => $this->input->post('txtPadre'),
                    'almTelCasa' => $this->input->post('txtTelCasa'),
                    'almTelCel' => $this->input->post('txtTelCel'),
                    'almCorreo' => $this->input->post('txtEmail'),
                    'almResponsable' => $this->input->post('txtResponsable'),
                    'almTelResponsable' => $this->input->post('txtTelResponsable'),
                    'grdId' => $this->input->post('cboGrdId'),
                    'almMadreDui' => $this->input->post('txtMadreDui'),
                    'almPadreDui' => $this->input->post('txtPadreDui'),
                    'dptId' => $this->input->post('cboDptId'),
                    'munId' => $this->input->post('cboMunId')
                );
                $b = $this->Alumno_model->agregar($data);
                if ($b['status'] == TRUE) {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro agregado exitosamente. El código es <strong>'. $b['value'] . '</strong></div>');
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> ' . $b['value'] . '</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Debe ingresar datos correctos</div>');
            }
            redirect('admin/alumno/');
        }

        function antiguo(){
            if ($this->input->post('btnAgregarA') && $this->input->post('cboAlumno')) {
                $data = array(
                    'almId' => $this->input->post('cboAlumno')
                 );
                $b = $this->Alumno_model->agregar($data);
                if ($b['status'] == TRUE) {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-success"><strong>¡Correcto!</strong> Registro agregado exitosamente. El código es <strong>'. $b['value'] . '</strong></div>');
                } else {
                    $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> ' . $b['value'] . '</div>');
                }
            } else {
                $this->session->set_flashdata('mensaje','<div class="alert alert-danger"><strong>¡Error!</strong> Debe ingresar datos correctos</div>');
            }
            redirect('admin/alumno/');
        }

        public function eliminar($value = null)
        {
            if (isset($value)) {
                $b = $this->Alumno_model->eliminar($value);
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