<?php
    class Login extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('session');
            //$this->load->module('login');
        }
        public function index(){
            if ($this->session->userdata('codigo')) {
                # code...
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
                if ($this->Login_model->verificar($carne, $pass)) {
                    //$this->session->set_userdata(array('codigo' => $carne, 'login' => TRUE));
                    echo 1;
                }else{
                    //$this->session->set_flashdata('incorrecto','Usurio o contraseña errorneos');
                    //redirect('login/');
                    echo 0;
                }
            }else{
                //$this->session->set_flashdata('incorrecto','Complete todos los campos');
                //redirect('login/');
                echo 2;
            }
        }
    }
?>