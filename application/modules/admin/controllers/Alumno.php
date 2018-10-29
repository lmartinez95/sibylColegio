<?php
    class Alumno extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Alumno_model');
        }

        public function index(){
            $data['title'] = 'Alumnos';
            $data['content_view'] = 'admin/alumno/index';
            $data['results'] = $this->Alumno_model->mostrar();
            $this->template->admin_dash($data);
        }

        public function matricula(){
            $data['title'] = 'Matricula Alumnos';
            $data['content_view'] = 'admin/alumno/matricula';
            $this->load->library('complements');
            $data['grado'] = $this->complements->cargaCombo('grdId','grdNombre','Grado');
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
                    'almNombre' => $_REQUEST['txtNombre'],
                    'almApellidoP' => $_REQUEST['txtApellidoP'],
                    'almApellidoM' => $_REQUEST['txtApellidoM'],
                    'almFechaNac' => $_REQUEST['dtpFechaNac'],
                    'almLugarNac' => $_REQUEST['txtLugarNac'],
                    'almSexo' => $_REQUEST['cboSexo'],
                    'almDireccion' => $_REQUEST['txtDireccion'],
                    'almMadre' => $_REQUEST['txtMadre'],
                    'almPadre' => $_REQUEST['txtPadre'],
                    'almTelCasa' => $_REQUEST['txtTelCasa'],
                    'almTelCel' => $_REQUEST['txtTelCel'],
                    'almCorreo' => $_REQUEST['txtEmail'],
                    'almResponsable' => $_REQUEST['txtResponsable'],
                    'almTelResponsable' => $_REQUEST['txtTelResponsable'],
                    'grdId' => $this->input->post('cboGrdId')
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