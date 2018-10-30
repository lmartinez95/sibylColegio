<?php
    class MY_Controller extends MX_Controller
    {
        function __construct()
        {
            parent::__construct();
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $login = base_url() . 'login/validar';
            if($url !== base_url() && $url !== $login)
                if(empty($this->session->userdata('codigo')))
                    redirect(base_url());
                else
                    $this->load->module('template');
        }
    }
    
?>