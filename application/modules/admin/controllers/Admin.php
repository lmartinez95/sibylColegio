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

    }
    
?>