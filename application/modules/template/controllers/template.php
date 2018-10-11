<?php
    class Template extends MY_Controller
    {
        function __construct(){
            parent::__construct();
        }

        function admin_dash($data = NULL){
            $this->load->view('template',$data);
        }
    }
    
?>