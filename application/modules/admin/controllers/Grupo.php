<?php
    class Grupo extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Grupo_model');
        }
        public function index($mensaje = NULL, $nivel = NULL){
            $this->load->library('complements');
            $data['results'] = $this->Grupo_model->mostrar();
            $data['empleado'] = $this->complements->cargaCombo('empId',"CONCAT(empNombre,' ',empApellidoP,' ',empApellidoM) AS nombre",'Empleado','tempId = 2');
            $data['materia'] = $this->complements->cargaCombo('matId','matNombre','Materia');
            $data['grado'] = $this->complements->cargaCombo('grdId','grdNombre','Grado');
            $data['title'] = 'Grupos';
            $data['content_view'] = 'admin/grupo/index';
            $this->template->admin_dash($data);
        }

        public function agregar()
        {
            if ($this->input->post('btnAgregar') !== NULL) {
                if(!empty($this->input->post('cboEmpId')) && !empty($this->input->post('cboMatId')) && !empty($this->input->post('cboGrdId'))){
                    $data = array(
                        'empId' => $this->input->post('cboEmpId'),
                        'matId' => $this->input->post('cboMatId'),
                        'grdId' => $this->input->post('cboGrdId'));
                    $b = $this->Grupo_model->agregar($data);
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
            
            redirect('admin/grupo/');
        }

        public function addAlumno($grupo)
        {
            $data['alumno'] = $this->Grupo_model->cargaAlumno($grupo);
            $data['grupo'] = $grupo;
            $data['title'] = 'Agregar alumnos';
            $this->load->view('shared/header', $data);
            $this->load->view('grupo/addAlumno', $data);
        }

        public function inscribir()
        {
            $grupo = $_REQUEST['grupo'];
            $opciones = explode(',',$_REQUEST['alumno']);
            $data = array();
            for ($i=0; $i < count($opciones); $i++) { 
                array_push($data,
                    array(
                        'grpId' => $grupo,
                        'almId' => $opciones[$i]
                    )
                );
            }
            
            $b = $this->Grupo_model->inscribir($data);
            if ($b === TRUE) {
                $mensaje = "Registros agregado exitosamente.";
                $nivel = 'success';
            } else {
                $mensaje = $b;
                $nivel = 'warning';
            }
            $this->index($mensaje,$nivel);
        }

        public function listado($grupo){
            $data['results'] = $this->Grupo_model->listado($grupo);
            $data['title'] = 'Detalle';
            $this->load->view('shared/header', $data);
            $this->load->view('grupo/listado', $data);
        }

        public function eliminar($value = null)
        {
            if (isset($value)) {
                $b = $this->Grupo_model->eliminar($value);
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