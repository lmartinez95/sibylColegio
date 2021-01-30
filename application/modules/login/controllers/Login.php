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
            //if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->input->method() === 'post' && $this->input->is_ajax_request()) {
                $validator = array();
                if (!empty($this->input->post('carne')) && !empty($this->input->post('pass'))){
                    $carne = $this->input->post('carne');
                    $pass = $this->input->post('pass');
                    $this->load->database();
                    $this->load->model('Login_model');
                    $query = $this->Login_model->verificar($carne, $pass);
                    if ($query) {
                        $results = $this->Login_model->getPermisos($query['rolId']);
                        $validator['status'] = true;
                        $validator['redirect'] = base_url() . 'index.php/' . $query['rolRedirect'];
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
                        $validator['status'] = false;
                    }
                }else{
                    $validator['status'] = false;
                }
            } else {
                $validator['status'] = false;
            }
            
            /* $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($validator, JSON_PRETTY_PRINT))
                ->_display(); */
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($validator, JSON_FORCE_OBJECT);
        }

        function logout(){
            if ($this->input->is_ajax_request()) {
                $this->session->sess_destroy();
                $validator['status'] = true;
                $validator['redirect'] = base_url();
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($validator, JSON_FORCE_OBJECT);
            }
            
        }
    }
?>