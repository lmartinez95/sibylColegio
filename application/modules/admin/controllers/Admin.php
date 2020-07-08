<?php
    class Admin extends MY_Controller
    {
        function __construct(){
            parent::__construct();
        }

        function index(){
            $data['title'] = 'Admin Dashboard';
            $data['content_view'] = 'admin/admin/index';
            $this->template->admin_dash($data);
        }

        public function cargaMunicipio()
        {
            if ($this->input->is_ajax_request() && $this->input->method() == 'get') {
                if(!empty($this->input->get('dptId'))){
                    $this->load->library('complements');
                    $result = $this->complements->cargaCombo('munId','munNombre','Municipio', 'dptId', $this->input->get('dptId'));
                    header('Content-type: application/json; charset=utf-8');
                    echo json_encode($result, JSON_FORCE_OBJECT);
                }
            }
        }

    }
    
?>