<?php
    class Login extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('session');
        }
        public function index(){
            if ($this->session->userdata('codigo')) {
                $ruta = base_url() . $this->session->userdata('redirect');
                redirect($ruta);
            } else {
                $this->load->view('login/index');
            }
        }
        
        public function validar(){
            if (!empty($this->input->post('carne')) && !empty($this->input->post('pass'))){
                $carne = $this->input->post('carne');
                $pass = $this->input->post('pass');
                $this->load->database();
                $this->load->model('Login_model');
                $validator = array();
                $query = $this->Login_model->verificar($carne, $pass);
                if ($query) {
                    $results = $this->Login_model->getPermisos($query['rolId']);
                    $validator['status'] = true;
                    $validator['redirect'] = base_url() . $query['rolRedirect'];
                    $permisos = array();
                    foreach ($results as $result) {
                        array_push($permisos, $result['accCodigo']);
                    }
                    $data = array(
                        "codigo" => $carne,
                        "usuario" => $query['usrNombre'],
                        "empId" => $query['empId'],
                        "almId" => $query['almId'],
                        "redirect" => $query['rolRedirect'],
                        "permisos" => $permisos,
                    );
                    $this->session->set_userdata($data);
                }else{
                    //$this->session->set_flashdata('incorrecto','Usurio o contraseña errorneos');
                    //redirect('login/');
                    $validator['status'] = false;
                }
            }else{
                //$this->session->set_flashdata('incorrecto','Complete todos los campos');
                //redirect('login/');
                $validator['status'] = false;
            }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($validator, JSON_FORCE_OBJECT);
        }

        function logout(){
            $this->session->sess_destroy();
            $validator['status'] = true;
            $validator['redirect'] = base_url();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($validator, JSON_FORCE_OBJECT);
        }
    }
?>