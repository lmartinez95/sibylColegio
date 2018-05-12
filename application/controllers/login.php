<?php
    class Login extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Login_model');
            $this->load->helper('url_helper');
        }
        public function index(){
            $this->load->view('login/index');
        }
        public function validar(){
            if ($this->input->post('carne') != NULL && $this->input->post('pass') != NULL && $this->input->post('tipo') != NULL){
                $carne = $this->input->post('carne');
                $pass = $this->input->post('pass');
                $tipo = $this->input->post('tipo');
                if ($this->Login_model->verificar($carne, $pass, $tipo)) {
                    $this->session->userdata(array('codigo' => $this->input->post('carne')));
                    if ($tipo == "Administrador"){
                        redirect('empleado');
                    }else if($tipo == "Profesor"){
                        redirect('profesor');
                    }
                }else{
                    $data['message'] = "El carné o contraseña son invalidos";
                    $this->load->view('login/index', $data);
                }
            }else{
                $data['message'] = "Complete todos los campos";
                $this->load->view('login/index', $data);
            }
        }
    }
?>